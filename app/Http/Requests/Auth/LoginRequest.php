<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan melakukan request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rules validasi form login.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Autentikasi user.
     * Cek akun Google + login manual.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->input('email'))->first();

        // Jika akun Google tapi password null
        if ($user && is_null($user->password) && !is_null($user->google_id)) {
            throw ValidationException::withMessages([
                'email' => 'Akun ini terdaftar melalui Google. Silakan login menggunakan tombol Google atau buat password baru.',
            ]);
        }

        // Login biasa
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }

    /**
     * Optional: rate limiter
     */
    protected function ensureIsNotRateLimited(): void
    {
        // Bisa ditambahkan rate limiter jika mau
    }
}
