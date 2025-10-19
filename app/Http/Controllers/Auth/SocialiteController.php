<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            $user = User::where('email', $googleUser->email)->first();

            $avatarPath = null;
            if ($googleUser->getAvatar()) {
                try {
                    $response = Http::get($googleUser->getAvatar());
                    if ($response->successful()) {
                        $fileName = 'avatars/' . Str::random(40) . '.jpg';
                        Storage::disk('public')->put($fileName, $response->body());
                        $avatarPath = $fileName; 
                    }
                } catch (Exception $e) {
                }
            }
            if ($user) {
                $user->update([
                    'google_id' => $user->google_id ?? $googleUser->id,
                    'google_token' => $googleUser->token,
                    'avatar' => $avatarPath ?? $user->avatar, 
                ]);
            } else {
                $user = DB::transaction(function () use ($googleUser, $avatarPath) {
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => null,
                        'avatar' => $avatarPath,
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

            if ($user->status === 'diblokir') {
                return redirect('/login')->with('error', 'Akun Anda telah diblokir...');
            }

            Auth::login($user);

            $redirectResponse = redirect()->intended('/customer/dashboard')
                ->with('success', 'Login dengan Google berhasil. Selamat datang, ' . $user->name . '!');

            if ($user->role === 'customer') {
                $redirectResponse->with('show_announcement_modal', true);
            }

            return $redirectResponse;
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}