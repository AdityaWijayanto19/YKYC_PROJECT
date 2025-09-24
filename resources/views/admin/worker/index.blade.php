@extends('layouts.admin')

@section('title', 'Manajemen Worker')

@push('styles')
    {{-- Jika ada style khusus untuk halaman ini, bisa ditambahkan di sini --}}
@endpush

@section('content')

    <div class="p-8">
        {{-- =============================================== --}}
        {{-- HEADER HALAMAN --}}
        {{-- =============================================== --}}
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-navy-dark">Manajemen Worker</h1>
                <p class="text-blue-medium mt-1">Kelola, tambahkan, atau hapus data worker di sini.</p>
            </div>
            <a href="{{ route('admin.worker.tambah') }}"
                class="mt-4 sm:mt-0 bg-navy-primary text-white font-semibold py-2 px-4 rounded-lg flex items-center gap-2 hover:bg-opacity-90 transition-colors">
                <i class="fas fa-plus-circle"></i>
                Tambah Worker Baru
            </a>
        </header>

        {{-- =============================================== --}}
        {{-- KONTEN UTAMA (TABEL) --}}
        {{-- =============================================== --}}
        <div class="bg-white p-6 rounded-2xl shadow-md">

            <!-- Bar Aksi: Search & Filter -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <div class="relative w-full sm:w-1/3">
                    <input type="text" placeholder="Cari worker..."
                        class="w-full pl-10 pr-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-blue-light"></i>
                </div>
                <div class="flex gap-4">
                    <select class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none">
                        <option>Filter Status</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                    <select class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none">
                        <option>Filter Jenis</option>
                        <option>Mangkal</option>
                        <option>Keliling</option>
                    </select>
                </div>
            </div>

            <!-- Container Tabel agar Responsif -->
            <div class="overflow-x-auto">
                <table class="w-full text-left min-w-[700px]">
                    <thead>
                        <tr class="border-b bg-slate-50">
                            <th class="py-3 px-4 font-semibold text-blue-medium">NAMA USER</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium">JENIS</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium">STATUS</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium">TANGGAL BERGABUNG</th>
                            <th class="py-3 px-4 font-semibold text-blue-medium text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Contoh Data User 1 --}}
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?u=budi" class="w-10 h-10 rounded-full"
                                    alt="Budi Santoso">
                                <div>
                                    <p class="font-semibold text-navy-dark">Budi Santoso</p>
                                    <p class="text-sm text-blue-light">budi.s@example.com</p>
                                </div>
                            </td>
                            <td class="px-4 text-blue-medium">Keliling</td>
                            <td class="px-4">
                                <span
                                    class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679;
                                    Aktif</span>
                            </td>
                            <td class="px-4 text-blue-medium">12 Okt 2023</td>
                            <td class="px-4 text-center">
                                <a href="{{ route('admin.worker.edit') }}"
                                    class="text-blue-medium hover:text-navy-primary p-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="text-red-500 hover:text-red-700 p-2 ml-2">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        {{-- Contoh Data User 2 --}}
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?u=citra" class="w-10 h-10 rounded-full"
                                    alt="Citra Lestari">
                                <div>
                                    <p class="font-semibold text-navy-dark">Citra Lestari</p>
                                    <p class="text-sm text-blue-light">citra.l@example.com</p>
                                </div>
                            </td>
                            <td class="px-4 text-blue-medium">Mangkal</td>
                            <td class="px-4">
                                <span
                                    class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679;
                                    Aktif</span>
                            </td>
                            <td class="px-4 text-blue-medium">10 Okt 2023</td>
                            <td class="px-4 text-center">
                                <a href="{{ route('admin.worker.edit') }}"
                                    class="text-blue-medium hover:text-navy-primary p-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="text-red-500 hover:text-red-700 p-2 ml-2">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        {{-- Contoh Data User 3 (Nonaktif) --}}
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?u=eko" class="w-10 h-10 rounded-full" alt="Eko Prasetyo">
                                <div>
                                    <p class="font-semibold text-navy-dark">Eko Prasetyo</p>
                                    <p class="text-sm text-blue-light">eko.p@example.com</p>
                                </div>
                            </td>
                            <td class="px-4 text-blue-medium">Keliling</td>
                            <td class="px-4">
                                <span
                                    class="text-sm text-amber-700 bg-amber-100 px-3 py-1 rounded-full font-semibold">&#9679;
                                    Nonaktif</span>
                            </td>
                            <td class="px-4 text-blue-medium">05 Sep 2023</td>
                            <td class="px-4 text-center">
                                <a href="{{ route('admin.worker.edit') }}"
                                    class="text-blue-medium hover:text-navy-primary p-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="text-red-500 hover:text-red-700 p-2 ml-2">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        {{-- === BARIS BARU 4 === --}}
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?u=diana" class="w-10 h-10 rounded-full"
                                    alt="Diana Putri">
                                <div>
                                    <p class="font-semibold text-navy-dark">Diana Putri</p>
                                    <p class="text-sm text-blue-light">diana.p@example.com</p>
                                </div>
                            </td>
                            <td class="px-4 text-blue-medium">Mangkal</td>
                            <td class="px-4">
                                <span
                                    class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679;
                                    Aktif</span>
                            </td>
                            <td class="px-4 text-blue-medium">01 Sep 2023</td>
                            <td class="px-4 text-center">
                                <a href="{{ route('admin.worker.edit') }}"
                                    class="text-blue-medium hover:text-navy-primary p-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="text-red-500 hover:text-red-700 p-2 ml-2">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        {{-- === BARIS BARU 5 === --}}
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 flex items-center gap-3">
                                <img src="https://i.pravatar.cc/40?u=ahmad" class="w-10 h-10 rounded-full"
                                    alt="Ahmad Fauzi">
                                <div>
                                    <p class="font-semibold text-navy-dark">Ahmad Fauzi</p>
                                    <p class="text-sm text-blue-light">ahmad.f@example.com</p>
                                </div>
                            </td>
                            <td class="px-4 text-blue-medium">Keliling</td>
                            <td class="px-4">
                                <span
                                    class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679;
                                    Aktif</span>
                            </td>
                            <td class="px-4 text-blue-medium">28 Agu 2023</td>
                            <td class="px-4 text-center">
                                <a href="{{ route('admin.worker.edit') }}"
                                    class="text-blue-medium hover:text-navy-primary p-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="text-red-500 hover:text-red-700 p-2 ml-2">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center mt-6">
                {{-- Teks pagination diperbarui --}}
                <p class="text-sm text-blue-light">Menampilkan 5 dari 25 data</p>
                <div class="flex gap-1">
                    <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">&laquo;</button>
                    <button class="px-3 py-1 border rounded-md bg-navy-primary text-white">1</button>
                    <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">2</button>
                    <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">3</button>
                    <button class="px-3 py-1 border rounded-md hover:bg-slate-100 text-blue-medium">&raquo;</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- Jika ada script khusus untuk halaman ini (misal: modal konfirmasi hapus), bisa ditambahkan di sini --}}
    <script>
        // console.log('Halaman manajemen worker dimuat.');
    </script>
@endpush