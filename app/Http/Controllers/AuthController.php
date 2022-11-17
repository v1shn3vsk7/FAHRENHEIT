<?php

namespace App\Http\Controllers;

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

use function PHPUnit\Framework\throwException;


class AuthController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private function canAuth(string $clientIp)
    {
        $row = \App\Models\Timeout::where('client', '=', $clientIp)->first();

        if ($row) {
            if (/* $row->attempt_number > 2 && */ (now()->diffInMinutes($row->updated_at) > 13)) {
                $row->delete();
                return true;
            }
            /* if ($row->attempt_number < 3) {
                $row->attempt_number++;
                $row->save();
            } */

            if ($row->attempt_number < 3)
                return true;
            return false;
        }
        \App\Models\Timeout::create(['client' => $clientIp, 'attempt_number' => 1]);
        return true;
    }

    private function addAttemptNumber(string $clientIp) 
    {
        $row = \App\Models\Timeout::where('client', '=', $clientIp)->first();

        if ($row && $row->attempt_number < 3) 
        {
            $row->attempt_number++;
            $row->save();
        }
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $clientIp = $request->ip();
        if(!\App\Http\Controllers\AuthController::canAuth($clientIp))
            return view('auth_msg', ['msg' => 'auth_timeout']);

        if (Auth::guard()->attempt($validated)) {
            return redirect('/profile');
        }

        //return redirect()->back();
        else {
            \App\Http\Controllers\AuthController::addAttemptNumber($clientIp);
            return view('auth_msg', ['msg' => 'auth_fail']);
        }
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function login_required()
    {
        return view('auth_msg', ['msg' => 'login_required']);
    }

    public function register(Request $request)
    {
        $clientIp = $request->ip();
        \App\Http\Controllers\AuthController::addAttemptNumber($clientIp);
        if (!\App\Http\Controllers\AuthController::canAuth($clientIp))
            return view('auth_msg', ['msg' => 'auth_timeout']);
        $validated = $request->validate([
            'login' => ['required', 'unique:users,login'],
            'password' => 'required',
            'email' => ['required', 'unique:users,email'],
            'city' => 'required',
            'phone' => ['required', 'unique:users,phone'],
            'birthdate' => 'required',
        ]);

        if (($validated['spam'] = $request->spam) == null) //проверка, которая 
            $validated['spam'] = 0;                      //предотвращает передачу null

        $user = \App\Models\User::create($validated);

        if (!Auth::guard()->attempt($validated))
            return view('auth_msg', ['msg' => 'sign_up_is_done_with_auth_errors']);


        /* $receiver_name = $user->login;
        $receiver_email = $user->email;
        Mail::send('sign_up_is_done_email', ['login' => $user->login], function($message)
         use ($receiver_name, $receiver_email) {
            $message->to($receiver_email, $receiver_name)->subject('Успешная регистрация 👍');
         }); */

        event(new Registered($user));

        //Auth::guard()->attempt($validated);
        return view('auth_msg', ['msg' => 'reg_succ']);
    }

    public function email_verification(EmailVerificationRequest $request)
    {
        if (!hash_equals(
            (string) $request->route('id'),
            (string) Auth::guard()->user()->id
        )) {
            return view('auth_msg', ['msg' => 'email_verificate_fail']);
        }

        if (!hash_equals(
            (string) $request->route('hash'),
            sha1(Auth::guard()->user()->email)
        )) {
            return view('auth_msg', ['msg' => 'email_verificate_fail']);
        }

        $user = \App\Models\User::findorfail(Auth::guard()->user()->id);
        if (!$user->email_verified_at) {
            $user->email_verified_at = time();
            $user->save();

            /* event(new Verified(Auth::guard()->user())); */
        }

        return view('auth_msg', ['msg' => 'email_verificate_succ']);
    }

    public function seller_signup(Request $request)
    {
        $validated = $request->validate([
            'companyName' => ['required', 'unique:sellers,companyName'],
            'INN' => ['required', 'unique:sellers,INN']
        ]);
        $validated['user'] = Auth::user()->id;
        \App\Models\Permission::create(['user' => Auth::user()->id, 'permission' => 'product.*']);

        \App\Models\Seller::create($validated);

        return redirect('/product_list');
    }
}
