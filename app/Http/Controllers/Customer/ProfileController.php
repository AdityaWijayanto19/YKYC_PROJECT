<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function edit()
    {
        $user = Auth::User();
        return view('customer.profile', [
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number_phone' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'address' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ]);

        $user->name = $request->name;
        $user->number_phone = $request->number_phone;

        if ($request->hasFile('avatar')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }

        $user->save();

        $user->customer()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $request->address,
                'latitude' => $request->latitude, 
                'longitude' => $request->longitude, 
            ]
        );
        
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
