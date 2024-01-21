<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailSend;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.email' => 'Masukkan Email yang Valid',
            'email.required' => 'Kolom Email Harus Diisi',
            'password.required' => 'Kolom Password Harus Diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'student' && Auth::user()->active == 0) {
                Auth::logout();
                return back()->with('loginError', 'Silahkan verifikasi email anda terlebih dahulu');
            }

            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/admin');
            } elseif (Auth::user()->role == 'teacher') {
                return redirect()->intended('/teacher');
            } else {
                return redirect()->intended('/student');
            }
        } else {
            return back()->with('loginError', 'Login Gagal!');
        }
    }

    public function verify($key)
    {
        $keyCheck = User::select('key')
            ->where('key', $key)
            ->exists();

        if ($keyCheck) {
            $user = User::where('key', $key)->first();
            $user->active = '1';
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
            return redirect('/login')->with('message', 'Akun anda sudah aktif, silakan login');
            ;
        } else {
            return "Keys Tidak Valid";
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('/');
    }

    public function resendVerificationEmail()
    {
        $user = Auth::user();

        // Check if the user is a student and not yet verified
        if ($user && $user->role == 'student' && $user->active == 0) {
            // Check if user has a valid key
            if ($user->key) {
                // Generate a signed verification URL
                $verificationUrl = URL::signedRoute('verification.verify', ['key' => $user->key]);

                // Send email verification notification
                Mail::to($user->email)->send(new MailSend(['key' => $user->key], $verificationUrl));

                return back()->with('loginError', 'Email verifikasi telah dikirim ulang. Silakan cek email Anda untuk memverifikasi. <a href="' . $verificationUrl . '">Kirim ulang lagi</a>');
            } else {
                // Handle the case where the user or key is not valid
                return back()->with('loginError', 'Tidak dapat mengirim ulang verifikasi email. User atau key tidak valid.');
            }
        }

        return back()->with('loginError', 'Tidak perlu mengirim ulang verifikasi email.');
    }

}
