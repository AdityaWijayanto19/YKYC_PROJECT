<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(5);
        return view('admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcement.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'required|boolean',
            'order' => 'required|integer|min:0',
        ]);
        $validated['image_path'] = $request->file('image_path')->store('announcements', 'public');
        Announcement::create($validated);
        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman baru berhasil ditambahkan.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'required|boolean',
            'order' => 'required|integer|min:0',
        ]);
        if ($request->hasFile('image_path')) {
            Storage::disk('public')->delete($announcement->image_path);
            $validated['image_path'] = $request->file('image_path')->store('announcements', 'public');
        }
        $announcement->update($validated);
        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        Storage::disk('public')->delete($announcement->image_path);
        $announcement->delete();
        return redirect()->route('admin.announcement.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}