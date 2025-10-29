<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function show()
    {
        if (!session('email')) {
            return redirect()->route('login')->with('error', 'Sesi verifikasi tidak ditemukan. Silakan coba mendaftar lagi.');
        }

        return view('auth.verify-code');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|numeric|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->verification_code !== $request->verification_code) {
            return back()->with('error', 'Kode verifikasi tidak valid.');
        }

        if (now()->isAfter($user->verification_code_expires_at)) {
            return back()->with('error', 'Kode verifikasi telah kedaluwarsa. Silakan daftar ulang untuk mendapatkan kode baru.');
        }

        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('customer.dashboard')->with('success', 'Akun Anda berhasil diverifikasi!');
    }
}