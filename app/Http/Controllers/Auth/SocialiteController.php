<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Mail\SendVerificationCodeMail;
use Illuminate\Support\Facades\Mail;

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
          
            if ($user) {
                if ($user->email_verified_at) {
                    if ($user->status === 'diblokir') {
                        return redirect('/login')->with('error', 'Akun Anda telah diblokir.');
                    }

                    Auth::login($user);
                    
                    $redirectResponse = redirect()->intended('/customer/dashboard')
                        ->with('success', 'Selamat datang kembali, ' . $user->name . '!');

                    if ($user->role === 'customer') {
                        $redirectResponse->with('show_announcement_modal', true);
                    }
                    return $redirectResponse;
                }
                
                $verificationCode = rand(100000, 999999);
                $user->update([
                    'verification_code' => $verificationCode,
                    'verification_code_expires_at' => now()->addMinutes(10),
                ]);

                Mail::to($user->email)->send(new SendVerificationCodeMail($verificationCode));
                return redirect()->route('verification.notice')
                    ->with('email', $user->email)
                    ->with('error', 'Akun Anda belum aktif. Kami telah mengirimkan kode verifikasi baru.');
            }
            
            else {
                $verificationCode = rand(100000, 999999);
                $newUser = DB::transaction(function () use ($googleUser, $verificationCode) {
                    $createdUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => null,
                        'google_token' => $googleUser->token,
                        'role' => 'customer',
                        'email_verified_at' => null,
                        'verification_code' => $verificationCode,
                        'verification_code_expires_at' => now()->addMinutes(10),
                    ]);

                    Customer::create(['user_id' => $createdUser->id]);
                    return $createdUser;
                });

                Mail::to($newUser->email)->send(new SendVerificationCodeMail($verificationCode));
                return redirect()->route('verification.notice')->with('email', $newUser->email);
            }

        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Terjadi kesalahan saat login dengan Google.');
        }
    }
}