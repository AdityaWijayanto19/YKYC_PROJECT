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
            'number_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ], [
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'number_phone' => $request->number_phone,
            'role'         => 'customer',
        ]);

        $user->customer()->create([
            'address' => $request->address,
        ]);

        // event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
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

            if ($user->status === 'diblokir') {
                Auth::logout(); 
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->with('error', 'Akun Anda telah diblokir. Silakan hubungi customer service untuk informasi lebih lanjut.');
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
