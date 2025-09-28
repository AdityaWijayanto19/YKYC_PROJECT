<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cek apakah email sudah ada di sistem
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Kalau user sudah ada tapi belum punya google_id → update
                if (is_null($user->google_id)) {
                    $user->update([
                        'name' => $googleUser->name,
                        'avatar' => $googleUser->avatar,
                        'google_id' => $googleUser->id,
                        'google_token' => $googleUser->token,
                        'google_refresh_token' => $googleUser->refreshToken,
                    ]);
                }
            } else {
                // Kalau user belum ada → buat user baru
                $user = DB::transaction(function () use ($googleUser) {
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => null,
                        'avatar' => $googleUser->avatar,
                        'google_token' => $googleUser->token,
                        'google_refresh_token' => $googleUser->refreshToken,
                        'role' => 'customer',
                        'email_verified_at' => now(),
                    ]);

                    Customer::create([
                        'user_id' => $newUser->id,
                    ]);

                    return $newUser;
                });
            }

            Auth::login($user);

            return redirect()->intended('/customer/dashboard')
                ->with('success', 'Login dengan Google berhasil. Selamat datang, ' . $user->name . '!');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}
