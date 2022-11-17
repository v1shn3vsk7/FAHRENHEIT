<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Exception;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\throwException;


class CatalogController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function catalog()
    {
        return view('catalog/catalog', ['products' => \App\Models\Product::all()]);
    }

    public function product(int $id)
    {
        $product = \App\Models\Product::find($id);

        return view('catalog/product', ['product' => $product], ['properties' => $product->properties]);
    }

    public function cart()
    {
        $items = \App\models\CartItem::all()->where('user', '=', Auth::user()->id);

        return view('catalog/cart', ['items' => $items]);
    }

    public function add_product_to_cart(int $product_id)
    {
        $item = \App\Models\CartItem::where('user', '=', Auth::user()->id)
            ->where('product', '=', $product_id)->first();
        
        

        if ($item) {
            if ($item->quantity + 1 > Warehouse::where('product', '=', $item->product)->first()->quantity)
            return;

            $item->quantity++;

            $item->save();

            return redirect()->back();
        }
        \App\Models\CartItem::create(['product' => $product_id, 'user' => Auth::user()->id, 'quantity' => 1]);

        return redirect()->back();
    }

    public function delete_from_cart(int $productId)
    {
        $item = CartItem::where('product', '=', $productId)
            ->where('user', '=', Auth::user()->id);

        $item->delete();

        return redirect()->back();
    }

    public function place_order() 
    {
        $usersItems = CartItem::all()->where('user', '=', Auth::user()->id);

        foreach ($usersItems as $item) 
        {
            $row = Warehouse::where('product', '=', $item->product)->first();
            
            if ($row) 
            {
                $row->quantity -= $item->quantity;

                if ($row->quantity >= 0)
                    $row->save();
                else return view('auth_msg', ['msg' =>'low_quantity_in_warehouse']);
            }
        }

        CartItem::where('user', '=', Auth::user()->id)->delete();

        return view('auth_msg', ['msg' =>'purchase_success']);
    }


    public function list_products()
    {
        $products = \App\Models\Product::all()->where('manufacturer_id', '=', Auth::user()->id);
        return view('catalog/product_list', ['products' => $products]);
    }

    public function add_product_request(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:products,name'],
            'alias' => ['required', 'unique:products,alias'],
            'short_desc' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'image' => 'file',
        ]);

        $validated['manufacturer_id'] = Auth::user()->seller->id;
        $validated['catalog'] = 1;

        $pic = $request->hasFile('image') ? $request->file('image') : false;
        $pic_tmp_path = $pic ? $pic->getPathName() : '';
        $validated['image'] = $pic ? 'products/' . $request->alias . '.png' : '';

        if ($pic) {
            @mkdir('products');
            copy($pic_tmp_path, $validated['image']);
        }
        $validated['image'] = $validated['image'] ? $validated['image'] : 'products/def/default.png';

        $product = \App\Models\Product::create($validated);

        for ($i = 1; ($i < 15 && $i <= $request['amogus']); $i++) {
            $prop = $request['prop_' . $i];
            $val = $request['value_' . $i];

            if ($prop && $val)
                \App\Models\Property::create(['product' => $product->id, 'property' => $prop, 'value' => $val]);
        }

        \App\Models\Warehouse::create(['product' => $product->id, 'quantity' => 0]);

        return redirect()->back();
    }

    public function edit_product_request(int $id, Request $request)
    {
        $product = Product::find($id);

        $validated = $request->validate([
            'name' => ['required', function ($attribute, $value, $fail) use ($product) {
                global $request;
                if ($product->name != $request->get('name'))
                    if (Product::where('name', '=', $request->get('name'))->first())
                        $fail('Имя занято!11111111111111111💀');
            }],
            'alias' => ['required', function ($attribute, $value, $fail) use ($product) {
                global $request;
                if ($product->alias != $request->get('alias'))
                    if (Product::where('alias', '=', $request->get('alias'))->first())
                        $fail('Имя занято!2222222');
            }],
            'short_desc' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'image' => 'file',
        ]);

        $validated['manufacturer_id'] = Auth::user()->seller->id;
        $validated['catalog'] = 1;

        $pic = $request->hasFile('image') ? $request->file('image') : false;
        $pic_tmp_path = $pic ? $pic->getPathName() : '';
        $validated['image'] = $pic ? 'products/' . $request->alias . '.png' : '';


        if ($pic) {
            @mkdir('products');
            copy($pic_tmp_path, $validated['image']);
            $product->image = $validated['image'] ? $validated['image'] : 'products/def/default.png';
        }

        $product->name = $validated['name'];
        $product->alias = $validated['alias'];
        $product->short_desc = $validated['short_desc'];
        $product->desc = $validated['desc'];
        $product->price = $validated['price'];


        $product->save();

        \App\Models\Property::where('product', '=', $product->id)->delete();

        for ($i = 1; (($i < 15 )&& ($i <= $request['amogus'])); $i++) {
            $prop = $request['prop_' . $i];
            $val = $request['value_' . $i];
            if ($prop && $val)
                \App\Models\Property::create(['product' => $product->id, 'property' => $prop, 'value' => $val]);
        }


        return redirect()->back();
    }

    public function delete_product($id) 
    {
        $product = Product::find($id);
        if($product->manufacturer_id!=Auth::user()->seller->id)
            return view('auth_msg', ['msg' =>'auth_wrong_product']);

        $product->delete();

        return redirect()->back();
    }

    public function update_stock(int $id, Request $request) 
    {  
        $validated = $request->validate([
        'value' => 'required',
    ]);
        
        $stock = Warehouse::where('Id', '=', $id)->first();
        if(!$stock)
            return;
        
        $stock->quantity = $validated['value'];

        $stock->update();

        return redirect()->back();
    }
}
