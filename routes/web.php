<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Property;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::view('/feedback', 'feedback');

Route::get('/razdel/{id}', [Controller::class, 'razdel']);

Route::get('/catalog', [CatalogController::class, 'catalog']);

Route::get('/product/{id}', [CatalogController::class, 'product']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('login_required', [AuthController::class, 'login_required'])->name('login');

Route::middleware('guest')->group(function () {
    Route::view('/signup', 'signup');
    Route::post('/signup_request', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::view('/profile', 'profile');
    Route::post('/profile_update', [ProfileController::class, 'update']);
    Route::get('/logout',  [AuthController::class, 'logout']);

    Route::view('/seller_signup', 'seller_signup');
    Route::post('/seller_signup_request', [AuthController::class, 'seller_signup']);

    Route::get('/shopping_cart', [CatalogController::class, 'cart']);
    Route::get('/add_to_cart/{id}', [CatalogController::class, 'add_product_to_cart']);
    Route::get('/delete_from_cart/{productId}', [CatalogController::class, 'delete_from_cart']);
    Route::get('/place_order', [CatalogController::class, 'place_order']);

    Route::get('/product_edit/{id}', function ($id) {
        $product = Product::find($id);
        if($product->manufacturer_id!=Auth::user()->seller->id)
            return view('auth_msg', ['msg' =>'auth_wrong_product']);
        $all_properties = Property::all()->pluck('property');

        return view(
            'catalog/edit_product',
            ['product' => $product, 'all_properties' => $all_properties]
        );
    });

    Route::post('/edit_product_request/{id}', [CatalogController::class, 'edit_product_request']);
    //Route::view('/product_edit/{id}', 'catalog/edit_product')->middleware('permission:product.edit');
    Route::get('/product_add', function(){
        $all_properties = Property::all()->pluck('property');
        return view('catalog/add_product',['all_properties' => $all_properties]);
    })->middleware('permission:product.add');
    Route::post('/delete_product/{id}', [CatalogController::class, 'delete_product']);
    Route::post('/product_add_request', [CatalogController::class, 'add_product_request'])->middleware('permission:product.add');
    //Route::get('/product_delete/{id}', [CatalogController::class, 'delete_product'])->middleware('permission:product.delete');
    Route::get('/product_list', [CatalogController::class, 'list_products'])->middleware('permission:product.view');
    Route::view('/warehouse', 'warehouse', ['products' => Product::all(), 'stocks' => Warehouse::all()])->middleware('permission:warehouse.view');
    Route::get('/update_stock/{id}', [CatalogController::class, 'update_stock'])->middleware('permission:warehouse.edit');
});


Route::get('/email_verify', function () {
    return view('auth_verify_email');
})->middleware('auth')->name('verification.notice');


Route::get(
    '/email_verify/{id}/{hash}',
    [AuthController::class, 'email_verification']

)->middleware(['auth', 'signed'])->name('verification.verify');
