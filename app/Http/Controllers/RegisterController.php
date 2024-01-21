<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailSend;
use Session;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required',
            'entry_year' => 'required',
            'phone' => 'required'
        ], [
            'first_name.required' => 'Kolom Nama Depan Harus Diisi',
            'email.required' => 'Kolom Email Harus Diisi',
            'email.email' => 'Isi Email dengan Benar',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain',
            'password.required' => 'Kolom Kata Sandi Harus Diisi',
            'password.min' => 'Panjang Kata Sandi minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi Kata Sandi tidak cocok',
            'gender.required' => 'Kolom Jenis Kelamin Harus Diisi',
            'entry_year.required' => 'Kolom Tahun Masuk Harus Diisi',
            'phone.required' => 'Kolom Nomor Telpon Harus Diisi',
        ]);

        $str = Str::random(100);
        $details = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'website' => 'myEdu',
            'role' => 'Student',
            'datetime' => now(),
            'url' => request()->getHttpHost() . '/register/' . $str,
            'key' => $str
        ];

        $url = request()->getHttpHost() . '/register/' . $str;

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->entry_year = $request->entry_year;
        $user->phone = $request->phone;
        $user->key = $str;

        $user->save();

        Mail::to($request->email)->send(new MailSend($details, $url));

        return redirect('/register')->with('message', 'Link verifikasi telah dikirim ke email Anda. Silakan cek email untuk memverifikasi');
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

    public function resendVerification(Request $request)
    {
        if ($request->user() && !$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        } else {
            return back()->with('error', 'Unable to resend verification link.');
        }
    }
    // public function resendVerification(Request $request)
    // {
    //     // Temukan pengguna berdasarkan alamat email
    //     $user = User::where('email', $request->email)->first();

    //     // Periksa apakah pengguna ada dan belum diverifikasi
    //     if ($user && !$user->hasVerifiedEmail()) {
    //         // Buat URL verifikasi baru
    //         $url = request()->getHttpHost() . '/register/resend-verification/' . $user->key;

    //         // Kirim ulang email verifikasi
    //         Mail::to($user->email)->send(new MailSend(['key' => $user->key], $url));

    //         return redirect('/register')->with('message', 'Link verifikasi telah dikirim ulang ke email Anda. Silakan cek email untuk memverifikasi');
    //     }

    //     return back()->with('registerError', 'Tidak dapat mengirim ulang email verifikasi.');
    // }
}
