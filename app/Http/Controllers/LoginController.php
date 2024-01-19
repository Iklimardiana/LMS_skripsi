<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 2 && Auth::user()->active == 0) {
                Auth::logout();
                return back()->with('loginError', 'Silahkan verifikasi email anda terlebih dahulu');
            }

            // return redirect()->intended('/admin');
            if(Auth::user()->role == 0){
                return redirect()->intended('/admin');
            }elseif(Auth::user()->role == 1){
                return redirect()->intended('/teacher');
            }else{
                return redirect()->intended('/student');
            }
        }

        return back()->with('loginError', 'login failed!');
    }
}
