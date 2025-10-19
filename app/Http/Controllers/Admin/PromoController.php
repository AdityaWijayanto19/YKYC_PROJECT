<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::latest()->paginate(5);
        return view('admin.promo.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promo.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'required|boolean',
        ]);

        $validated['image_path'] = $request->file('image_path')->store('promos', 'public');

        Promo::create($validated);

        return redirect()->route('admin.promo.index')->with('success', 'Promo baru berhasil ditambahkan.');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promo.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
            'is_active' => 'required|boolean',
        ]);

        if ($request->hasFile('image_path')) {
            Storage::disk('public')->delete($promo->image_path);
            $validated['image_path'] = $request->file('image_path')->store('promos', 'public');
        }

        $promo->update($validated);

        return redirect()->route('admin.promo.index')->with('success', 'Data promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        Storage::disk('public')->delete($promo->image_path);
        $promo->delete();
        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus.');
    }
}