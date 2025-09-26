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
    /**
     * Tampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Register user baru
     */
    public function register(Request $request)
    {
        // Validasi input + unique email
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

        // Buat user baru
        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'number_phone' => $request->number_phone,
            'role'         => 'customer',
        ]);

        // Buat profil customer
        $user->customer()->create([
            'address' => $request->address,
        ]);

        // kirim email
        event(new Registered($user));

        // Login otomatis
        Auth::login($user);

        return redirect()->route('verification.notice');

        // return redirect()->route('customer.dashboard')
        //     ->with('success', 'Registrasi berhasil, Anda sudah login.');
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

        // login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // dashboard sesuai role
            if (Auth::user()->role === 'customer') {
                return redirect()->route('customer.dashboard');
            } elseif (Auth::user()->role === 'worker') {
                return redirect()->route('worker.dashboard');
            } elseif (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        // gagal login
        return back()->withErrors([
            'login' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
