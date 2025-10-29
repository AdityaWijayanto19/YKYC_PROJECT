<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where('email', $this->input('email'))->first();

        if ($user && is_null($user->password) && !is_null($user->google_id)) {
            throw ValidationException::withMessages([
                'email' => 'Akun ini terdaftar melalui Google. Silakan login menggunakan tombol Google.',
            ]);
        }

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $authenticatedUser = Auth::user();
        if ($authenticatedUser->email_verified_at === null) {
            Auth::logout(); 
           
            throw ValidationException::withMessages([
                'email' => 'Akun Anda belum aktif. Silakan cek email Anda untuk kode verifikasi.',
            ]);
        }
    }

    protected function ensureIsNotRateLimited(): void {}
}
