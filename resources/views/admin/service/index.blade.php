@extends('layouts.admin')

@section('title', 'Manajemen Layanan')

@section('content')
<div class="p-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Manajemen Layanan</h1>
            <p class="text-blue-medium mt-1">Lihat, tambah, dan ubah layanan yang ditawarkan.</p>
        </div>
        <div>
            <a href="{{ route('admin.service.tambah') }}" class="bg-navy-primary text-white font-semibold py-2 px-4 rounded-lg hover:bg-opacity-90 transition-colors">
                + Tambah Layanan
            </a>
        </div>
    </header>

    <div class="bg-white p-6 rounded-2xl shadow-md">
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="py-3 px-4 font-semibold text-blue-medium">NAMA LAYANAN</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">HARGA</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4">
                                <p class="font-semibold text-navy-dark">{{ $service->name }}</p>
                                <p class="text-sm text-blue-medium mt-1">{{ Str::limit($service->description, 70) }}</p>
                            </td>
                            <td class="py-4 px-4 font-semibold text-navy-primary">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.service.edit', $service->id) }}" class="flex items-center justify-center gap-1.5 bg-blue-100 hover:bg-blue-200 text-blue-800 font-semibold px-3 py-1 rounded-md text-sm transition-colors" title="Edit Layanan">
                                        <i class="fas fa-edit"></i> <span>Edit</span>
                                    </a>
                                     <form action="{{ route('admin.service.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-1.5 bg-red-100 hover:bg-red-200 text-red-800 font-semibold px-3 py-1 rounded-md text-sm transition-colors" title="Hapus Layanan">
                                            <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-8 text-blue-medium">Belum ada data layanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection