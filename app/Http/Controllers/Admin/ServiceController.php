<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Menampilkan daftar semua service.
     */
    public function index()
    {
        $services = Service::latest()->paginate(10);
        // Path view diubah ke 'admin.service.index'
        return view('admin.service.index', compact('services'));
    }

    /**
     * ==========================================================
     *  METHOD BARU: Menampilkan form untuk membuat service baru.
     * ==========================================================
     */
    public function create()
    {
        // Path view diubah ke 'admin.service.create'
        return view('admin.service.tambah');
    }

    /**
     * ==========================================================
     *  METHOD BARU: Menyimpan service baru ke database.
     * ==========================================================
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // 2. Buat data service baru
        Service::create($validated);

        // 3. Redirect ke halaman daftar dengan pesan sukses
        // Nama route diubah ke 'admin.service.index'
        return redirect()->route('admin.service.index')->with('success', 'Layanan baru berhasil ditambahkan.');
    }


    /**
     * Menampilkan form untuk mengedit service.
     */
    public function edit(Service $service)
    {
        // Path view diubah ke 'admin.service.edit'
        return view('admin.service.edit', compact('service'));
    }

    /**
     * Memperbarui data service di database.
     */
    public function update(Request $request, Service $service)
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Update
        $service->update($validated);

        // Redirect
        // Nama route diubah ke 'admin.service.index'
        return redirect()->route('admin.service.index')->with('success', 'Data layanan berhasil diperbarui.');
    }

    /**
     * Menghapus service. (Kita tambahkan juga fungsi destroy untuk kelengkapan)
     */
    public function destroy(Service $service)
    {
        $service->delete();
        // Nama route diubah ke 'admin.service.index'
        return redirect()->route('admin.service.index')->with('success', 'Layanan berhasil dihapus.');
    }
}