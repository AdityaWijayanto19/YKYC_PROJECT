<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Penting untuk mengelola file

class ProfileController extends Controller
{
    /**
     * Menampilkan form untuk mengedit profil pengguna yang sedang login.
     */
    public function edit()
    {
        // Kode Anda di sini sudah sempurna.
        $user = Auth::User();
        return view('customer.profile', [
            'user' => $user
        ]);
    }

    /**
     * Mengupdate profil pengguna yang sedang login.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi Input (Termasuk Password dan Foto)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number_phone' => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'address' => ['nullable', 'string', 'max:255']
        ]);

        // 2. Update Informasi Dasar (Nama dan Telepon)
        $user->name = $request->name;
        $user->number_phone = $request->number_phone;

        // 3. Proses Upload Foto Profil (Jika ada)
        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada untuk menghemat space
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            // Simpan foto baru di 'storage/app/public/profile-photos'
            // dan simpan path-nya ke database.
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->avatar = $path;
        }

        // 5. Simpan semua perubahan ke database
        $user->save();

        $user->customer()->updateOrCreate(
            ['user_id' => $user->id], // Kondisi untuk mencari data customer
            ['address' => $request->address]  // Data yang akan di-update atau dibuat
        );

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
