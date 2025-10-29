<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendVerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted', 
        ], [
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'terms.accepted' => 'Anda harus menyetujui Syarat & Ketentuan untuk melanjutkan.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $verificationCode = rand(100000, 999999);
        $expiresAt = now()->addMinutes(10);

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'number_phone' => $request->number_phone,
            'role'         => 'customer',
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => $expiresAt,
        ]);

        $user->customer()->create([
            'address' => $request->address,
        ]);

        Mail::to($user->email)->send(new SendVerificationCodeMail($verificationCode));

        return redirect()->route('verification.notice')->with('email', $user->email);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 

            if ($user->email_verified_at === null) {
                Auth::logout(); 
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('verification.notice')
                    ->with('email', $user->email) 
                    ->with('error', 'Akun Anda belum aktif. Silakan masukkan kode verifikasi yang telah kami kirimkan.');
            }
           
            if ($user->status === 'diblokir') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('error', 'Akun Anda telah diblokir. Silakan hubungi customer service.');
            }

            $request->session()->regenerate();

            $redirectRoute = 'customer.dashboard';
            if ($user->role === 'worker') {
                $redirectRoute = 'worker.dashboard';
            } elseif ($user->role === 'admin') {
                $redirectRoute = 'admin.dashboard';
            }
            $redirectResponse = redirect()->route($redirectRoute);
            if ($user->role === 'customer') {
                $redirectResponse->with('show_announcement_modal', true);
            }
            return $redirectResponse;
        }

        return back()->withErrors([
            'error' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
