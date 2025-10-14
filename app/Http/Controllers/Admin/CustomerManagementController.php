<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
{
    /**
     * Menampilkan daftar semua customer.
     */
    public function index()
    {
        $customers = User::where('role', 'customer')
                           ->withCount('orders')
                           ->latest()
                           ->paginate(10); // Kita naikkan jadi 10 per halaman

        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Memblokir atau mengaktifkan kembali akun customer.
     */
    public function toggleBlock(User $user)
    {
        // Pastikan kita tidak memblokir user yang bukan customer
        if ($user->role !== 'customer') {
            return back()->with('error', 'Aksi tidak diizinkan untuk pengguna ini.');
        }

        // Ubah status
        $user->status = ($user->status == 'aktif') ? 'diblokir' : 'aktif';
        $user->save();

        $message = ($user->status == 'diblokir') ? 'Customer berhasil diblokir.' : 'Customer berhasil diaktifkan kembali.';

        return back()->with('success', $message);
    }

    /**
     * Menghapus data customer secara permanen.
     */
    public function destroy(User $user)
    {
        // Pastikan kita tidak menghapus user yang bukan customer
        if ($user->role !== 'customer') {
            return back()->with('error', 'Aksi tidak diizinkan untuk pengguna ini.');
        }
        
        $userName = $user->name;
        $user->delete();

        return back()->with('success', "Customer bernama '{$userName}' telah berhasil dihapus.");
    }
}