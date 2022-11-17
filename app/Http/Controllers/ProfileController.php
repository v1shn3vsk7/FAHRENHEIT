<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

use function PHPUnit\Framework\throwException;


class ProfileController extends BaseController
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'img' => 'file',
            //'login' => ['required', 'unique:users,login'],
            'password' => function($atribute, $value, $fail){
                global $request;
                if($request->get('psw-repeat')!=$request->get('password'))
                $fail('Пароли не совпадают💀');
            },
            //'email' => ['required', 'unique:users,email'],
            'city' => 'required',
            //'phone' => ['required', 'unique:users,phone'],
            'birthdate' => 'required',
            'password-old' => ['required', function($atribute, $value, $fail){
                global $request;
                if(Auth::guard()->user()->password !== $request->get('password-old'))
                $fail('Неверный текущий пароль!!!11!!!');
            }]
        ]);

        $validated['spam'] = $request->spam;

        if ($request->spam == null)
            $validated['spam'] = 0;

        $pic = $request->hasFile('img') ? $request->file('img') : false;
        $pic_tmp_path = $pic ? $pic->getPathName() : '';
        $validated['img'] = $pic ? 'avatars/' . $request->login . '.png' : '';

        $user = Auth::user(); 
        /* $user = \App\Models\User::findorfail(Auth::guard()->user()->id); */
        if ($pic) {
            @mkdir('avatars');
            copy($pic_tmp_path, $validated['img']);
            $user->img = $validated['img'] ? $validated['img'] : 'avatars/def/avatar.jpg';
        }

        
        //$user->email = $validated['email'];
        if($request->get('password'))
            $user->password = $request->get('password');
        $user->birthdate = $validated['birthdate'];
        $user->city = $validated['city'];
        //$user->phone = $validated['phone'];
        $user->spam = $validated['spam'];
        

        $user->save();

        return redirect('/profile');
    }
}
