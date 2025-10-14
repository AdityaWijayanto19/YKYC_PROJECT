@extends('layouts.admin')
@section('title', 'Manajemen Worker')

{{-- Menambahkan style khusus untuk halaman ini --}}
@push('styles')
<style>
    /* Menyesuaikan tampilan default pagination Laravel agar lebih minimalis */
    .pagination {
        display: flex;
        justify-content: end;
        align-items: center;
        gap: 0.5rem;
    }
    .pagination li a, .pagination li span {
        padding: 0.5rem 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        color: #475569;
        font-size: 0.875rem;
    }
    .pagination li.active span {
        background-color: #052659; /* navy-primary */
        color: white;
        border-color: #052659;
    }
    .pagination li.disabled span {
        color: #94a3b8;
    }
    .pagination li a:hover {
        background-color: #f1f5f9;
    }
</style>
@endpush

@section('content')
    {{-- Di Laravel, kita sering menggunakan padding 'px-4 sm:px-6 lg:px-8' untuk konsistensi --}}
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        {{-- HEADER HALAMAN --}}
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                {{-- Menggunakan warna teks yang lebih gelap untuk kontras --}}
                <h1 class="text-3xl font-bold text-slate-800">Manajemen Worker</h1>
                <p class="text-slate-500 mt-1">Kelola, tambahkan, atau hapus data worker di sini.</p>
            </div>
            <a href="{{ route('admin.worker.tambah') }}"
                class="mt-4 sm:mt-0 bg-slate-800 text-white font-semibold py-2 px-4 rounded-lg flex items-center gap-2 hover:bg-slate-900 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Worker Baru</span>
            </a>
        </header>

        {{-- KONTEN UTAMA (TABEL) --}}
        <div class="bg-white p-6 rounded-2xl shadow-lg">

            <!-- Bar Aksi: Search & Filter -->
            <form action="{{ route('admin.worker.index') }}" method="GET">
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                    <div class="relative w-full sm:w-2/5">
                        <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <div class="flex gap-4">
                        <select name="status" class="border border-slate-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" onchange="this.form.submit()">
                            <option value="">Filter Status</option>
                            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <select name="jenis" class="border border-slate-300 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" onchange="this.form.submit()">
                            <option value="">Filter Jenis</option>
                            <option value="Mangkal" {{ request('jenis') == 'Mangkal' ? 'selected' : '' }}>Mangkal</option>
                            <option value="Keliling" {{ request('jenis') == 'Keliling' ? 'selected' : '' }}>Keliling</option>
                        </select>
                    </div>
                </div>
            </form>

            <!-- Container Tabel agar Responsif -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50">
                            <th class="py-3 px-4 text-sm font-semibold text-slate-500">NAMA USER</th>
                            <th class="py-3 px-4 text-sm font-semibold text-slate-500">JENIS</th>
                            <th class="py-3 px-4 text-sm font-semibold text-slate-500">STATUS</th>
                            <th class="py-3 px-4 text-sm font-semibold text-slate-500">TANGGAL BERGABUNG</th>
                            <th class="py-3 px-4 text-sm font-semibold text-slate-500">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-3">
                                        {{-- PENGGUNAAN LARAVOLT AVATAR --}}
                                        <img src="{{ \Laravolt\Avatar\Facade::create($user->name)->toBase64() }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $user->name }}">
                                        <div>
                                            <p class="font-semibold text-slate-800">
                                                {{ $user->name }}
                                                {{-- Menambahkan lokasi jika worker mangkal --}}
                                                @if($user->worker?->worker_type == 'Mangkal' && $user->worker?->location_name != 'Belum diatur')
                                                    <span class="font-normal text-slate-500">({{ $user->worker->location_name }})</span>
                                                @endif
                                            </p>
                                            <p class="text-sm text-slate-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 text-slate-600">{{ $user->worker->worker_type ?? 'N/A' }}</td>
                                <td class="px-4">
                                    {{-- DESAIN ULANG STATUS BADGE --}}
                                    @if($user->worker?->is_active)
                                        <span class="inline-flex items-center gap-1.5 text-xs font-medium bg-green-100 text-green-700 px-3 py-1 rounded-full">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-xs font-medium bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">
                                            <span class="w-2 h-2 rounded-full bg-yellow-500"></span> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 text-slate-600">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-4">
                                    {{-- DESAIN ULANG TOMBOL AKSI --}}
                                    <div class="flex items-center gap-4">
                                        <a href="{{ route('admin.worker.edit', $user->id) }}" class="flex items-center gap-1.5 text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.worker.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus worker ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center gap-1.5 text-red-600 hover:text-red-800 font-medium text-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-slate-500">
                                    Tidak ada data worker yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{-- Ini akan menggunakan style yang kita definisikan di atas --}}
                {{ $users->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection