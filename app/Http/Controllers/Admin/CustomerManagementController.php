<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerManagementController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
                           ->withCount('orders')
                           ->latest()
                           ->paginate(10); 

        return view('admin.customer.index', compact('customers'));
    }

    public function toggleBlock(User $user)
    {
        if ($user->role !== 'customer') {
            return back()->with('error', 'Aksi tidak diizinkan untuk pengguna ini.');
        }

        $user->status = ($user->status == 'aktif') ? 'diblokir' : 'aktif';
        $user->save();

        $message = ($user->status == 'diblokir') ? 'Customer berhasil diblokir.' : 'Customer berhasil diaktifkan kembali.';

        return back()->with('success', $message);
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'customer') {
            return back()->with('error', 'Aksi tidak diizinkan untuk pengguna ini.');
        }
        
        $userName = $user->name;
        $user->delete();

        return back()->with('success', "Customer bernama '{$userName}' telah berhasil dihapus.");
    }
}