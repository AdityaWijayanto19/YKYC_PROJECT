@extends('layouts.admin')
@section('title', 'Manajemen Pengumuman')

@section('content')
<div class="p-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Manajemen Pengumuman</h1>
            <p class="text-blue-medium mt-1">Kelola pengumuman modal yang tampil setelah customer login.</p>
        </div>
        <a href="{{ route('admin.announcement.tambah') }}" class="bg-primary text-white font-semibold py-2 px-4 rounded-lg hover:bg-opacity-90 transition-colors">+ Tambah Pengumuman</a>
    </header>

    <div class="bg-white p-6 rounded-2xl shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="p-4 font-semibold text-blue-medium">GAMBAR</th>
                        <th class="p-4 font-semibold text-blue-medium">JUDUL</th>
                        <th class="p-4 font-semibold text-blue-medium">STATUS</th>
                        <th class="p-4 font-semibold text-blue-medium text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $announcement)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-4">
                            <img src="{{ asset('storage/' . $announcement->image_path) }}" alt="{{ $announcement->title }}" class="w-32 h-16 object-cover rounded-md">
                        </td>
                        <td class="p-4">
                            <p class="font-semibold text-navy-dark">{{ $announcement->title }}</p>
                            <p class="text-sm text-blue-medium mt-1">{{ Str::limit($announcement->description, 60) }}</p>
                        </td>
                        <td class="p-4">
                            @if($announcement->is_active)
                                <span class="text-sm text-green-800 bg-green-100 px-3 py-1 rounded-full font-semibold">Aktif</span>
                            @else
                                <span class="text-sm text-red-800 bg-red-100 px-3 py-1 rounded-full font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="p-4">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.announcement.edit', $announcement->id) }}" class="flex items-center gap-1.5 bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold px-3 py-1 rounded-md text-sm">Edit</a>
                                <form action="{{ route('admin.announcement.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center gap-1.5 bg-red-100 hover:bg-red-200 text-red-800 font-semibold px-3 py-1 rounded-md text-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-8 text-blue-medium">Belum ada data pengumuman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">{{ $announcements->links() }}</div>
    </div>
</div>
@endsection