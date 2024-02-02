<?php

namespace App\Http\Controllers;

use App\Mail\MailResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailSend;
use App\Models\ResetPassword;
use App\Models\User;

class ResetPasswordController extends Controller
{
    public function forgot_password()
    {
        return view('auth.forgot_password');
    }

    public function store(Request $request)
    {
        $str = Str::random(100);

        $details = [
            'website' => 'MyEdu',
            'datetime' => date('Y-m-d H:i:s'),
            'url' => request()->getHttpHost() . '/reset/' . $str,
            'key' => $str,
        ];

        $request->validate([
            'email' => 'required|email',
        ], [
            'email.email' => 'Isi Email Dengan Benar',
            'email.required' => 'Kolom Email Harus Diisi'
        ]);

        $user = User::where('email', $request->email)->exists();

        if ($user) {
            Mail::to($request->email)->send(new MailResetPassword($details));
            $resetPassword = new ResetPassword();
            $resetPassword->email = $request->email;
            $resetPassword->key = $str;

            $resetPassword->save();
            return redirect('/forgot')->with('message', 'Silahkan buka Email anda untuk mereset Password');
        } else {
            return redirect('/forgot')->with('error', 'Email tidak terdaftar');
        }
    }

    public function verify($key)
    {
        $keyCheck = ResetPassword::select('key')
            ->where('key', $key)
            ->exists();
        if ($keyCheck) {
            $resetPassword = ResetPassword::where('key', $key)->first();
            return view('auth.new_password', ['resetPassword' => $resetPassword]);
        } else {
            return "Keys tidak valid";
        }
    }

    public function reset(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Kolom Kata Sandi Harus Diisi',
            'password.min' => 'Panjang Kata Sandi minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi Kata Sandi tidak cocok',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        $resetPassword = ResetPassword::where('email', $request->email)->first();
        $resetPassword->delete();

        return redirect('/login')->with('message', 'Kata sandi berhasil direset');
    }
}
