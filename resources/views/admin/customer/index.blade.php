@extends('layouts.admin')

@section('title', 'Manajemen Customer')

@section('content')

<div class="p-8">
    {{-- =============================================== --}}
    {{-- HEADER HALAMAN --}}
    {{-- =============================================== --}}
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Manajemen Customer</h1>
            <p class="text-blue-medium mt-1">Lihat, kelola, dan nonaktifkan akun customer.</p>
        </div>
        {{-- Sesuai permintaan, tidak ada tombol "Tambah Customer" --}}
    </header>

    {{-- =============================================== --}}
    {{-- KONTEN UTAMA (TABEL) --}}
    {{-- =============================================== --}}
    <div class="bg-white p-6 rounded-2xl shadow-md">
        
        <!-- Bar Aksi: Search & Filter -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="relative w-full sm:w-1/3">
                <input type="text" placeholder="Cari customer (nama atau email)..." class="w-full pl-10 pr-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-blue-light"></i>
            </div>
            <div class="flex gap-4">
                <select class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none">
                    <option>Filter Status</option>
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                    <option>Diblokir</option>
                </select>
                <input type="date" class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none text-blue-medium">
            </div>
        </div>

        <!-- Container Tabel agar Responsif -->
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="py-3 px-4 font-semibold text-blue-medium">NAMA CUSTOMER</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">STATUS</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">TANGGAL DAFTAR</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium text-center">TOTAL PESANAN</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh Data Customer 1 --}}
                    <tr class="border-b hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 flex items-center gap-3">
                            <img src="https://i.pravatar.cc/40?u=indah" class="w-10 h-10 rounded-full" alt="Indah Sari">
                            <div>
                                <p class="font-semibold text-navy-dark">Indah Sari</p>
                                <p class="text-sm text-blue-light">indah.s@example.com</p>
                            </div>
                        </td>
                        <td class="px-4">
                            <span class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679; Aktif</span>
                        </td>
                        <td class="px-4 text-blue-medium">25 Okt 2023</td>
                        <td class="px-4 text-blue-medium text-center font-semibold">12</td>
                        <td class="px-4 text-center">
                            <a href="{{ route('admin.customer.edit') }}" class="text-blue-medium hover:text-navy-primary p-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="text-red-500 hover:text-red-700 p-2 ml-2">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </td>
                    </tr>

                    {{-- Contoh Data Customer 2 (Nonaktif) --}}
                    <tr class="border-b hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 flex items-center gap-3">
                            <img src="https://i.pravatar.cc/40?u=rendy" class="w-10 h-10 rounded-full" alt="Rendy Pratama">
                            <div>
                                <p class="font-semibold text-navy-dark">Rendy Pratama</p>
                                <p class="text-sm text-blue-light">rendy.p@example.com</p>
                            </div>
                        </td>
                        <td class="px-4">
                            <span class="text-sm text-amber-700 bg-amber-100 px-3 py-1 rounded-full font-semibold">&#9679; Nonaktif</span>
                        </td>
                        <td class="px-4 text-blue-medium">22 Okt 2023</td>
                        <td class="px-4 text-blue-medium text-center font-semibold">3</td>
                        <td class="px-4 text-center">
                            <button class="text-blue-medium hover:text-navy-primary p-2">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="text-red-500 hover:text-red-700 p-2 ml-2">
                                <i class="fas fa-trash-alt"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    
                    {{-- Contoh Data Customer 3-5 --}}
                    <tr class="border-b hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 flex items-center gap-3"><img src="https://i.pravatar.cc/40?u=sinta" class="w-10 h-10 rounded-full" alt="Sinta Dewi"><div><p class="font-semibold text-navy-dark">Sinta Dewi</p><p class="text-sm text-blue-light">sinta.d@example.com</p></div></td>
                        <td class="px-4"><span class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679; Aktif</span></td>
                        <td class="px-4 text-blue-medium">19 Okt 2023</td>
                        <td class="px-4 text-blue-medium text-center font-semibold">25</td>
                        <td class="px-4 text-center"><button class="text-blue-medium hover:text-navy-primary p-2"><i class="fas fa-edit"></i> Edit</button><button class="text-red-500 hover:text-red-700 p-2 ml-2"><i class="fas fa-trash-alt"></i> Hapus</button></td>
                    </tr>
                    <tr class="border-b hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 flex items-center gap-3"><img src="https://i.pravatar.cc/40?u=agus" class="w-10 h-10 rounded-full" alt="Agus Setiawan"><div><p class="font-semibold text-navy-dark">Agus Setiawan</p><p class="text-sm text-blue-light">agus.s@example.com</p></div></td>
                        <td class="px-4"><span class="text-sm text-red-700 bg-red-100 px-3 py-1 rounded-full font-semibold">&#9679; Diblokir</span></td>
                        <td class="px-4 text-blue-medium">15 Okt 2023</td>
                        <td class="px-4 text-blue-medium text-center font-semibold">1</td>
                        <td class="px-4 text-center"><button class="text-blue-medium hover:text-navy-primary p-2"><i class="fas fa-edit"></i> Edit</button><button class="text-red-500 hover:text-red-700 p-2 ml-2"><i class="fas fa-trash-alt"></i> Hapus</button></td>
                    </tr>
                    <tr class="border-b hover:bg-slate-50 transition-colors">
                        <td class="py-4 px-4 flex items-center gap-3"><img src="https://i.pravatar.cc/40?u=wulan" class="w-10 h-10 rounded-full" alt="Wulandari"><div><p class="font-semibold text-navy-dark">Wulandari</p><p class="text-sm text-blue-light">wulan@example.com</p></div></td>
                        <td class="px-4"><span class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679; Aktif</span></td>
                        <td class="px-4 text-blue-medium">11 Okt 2023</td>
                        <td class="px-4 text-blue-medium text-center font-semibold">8</td>
                        <td class="px-4 text-center"><button class="text-blue-medium hover:text-navy-primary p-2"><i class="fas fa-edit"></i> Edit</button><button class="text-red-500 hover:text-red-700 p-2 ml-2"><i class="fas fa-trash-alt"></i> Hapus</button></td>
                    </tr>

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-sm text-blue-light">Menampilkan 5 dari 150 data</p>
            <div class="flex gap-1">
                <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">&laquo;</button>
                <button class="px-3 py-1 border rounded-md bg-navy-primary text-white">1</button>
                <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">2</button>
                <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">3</button>
                <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">...</button>
                <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">15</button>
                <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">&raquo;</button>
            </div>
        </div>
    </div>
</div>

@endsection