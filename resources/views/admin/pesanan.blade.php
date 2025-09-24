@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')

<div class="p-8">
    {{-- =============================================== --}}
    {{-- HEADER HALAMAN --}}
    {{-- =============================================== --}}
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Manajemen Pesanan</h1>
            <p class="text-blue-medium mt-1">Kontrol dan monitor semua alur pesanan dari awal hingga selesai.</p>
        </div>
    </header>

    {{-- =============================================== --}}
    {{-- KONTEN UTAMA (TABEL) --}}
    {{-- =============================================== --}}
    <div class="bg-white p-6 rounded-2xl shadow-md">
        
        <!-- Bar Aksi: Search & Filter -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="relative w-full sm:w-1/3">
                <input type="text" placeholder="Cari ID Pesanan atau Customer..." class="w-full pl-10 pr-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-blue-light"></i>
            </div>
            <div class="flex gap-4">
                <select class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none">
                    <option>Semua Status</option>
                    <option>Baru</option>
                    <option>Diproses</option>
                    <option>Selesai</option>
                    <option>Dibatalkan</option>
                </select>
                <input type="date" class="border border-blue-pale rounded-lg py-2 px-3 focus:outline-none text-blue-medium">
            </div>
        </div>

        <!-- Container Tabel agar Responsif -->
        <div class="hide-x-scroll">
            <table class="w-full text-left min-w-[900px]">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="py-3 px-4 font-semibold text-blue-medium">ID PESANAN</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">CUSTOMER</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">TANGGAL</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">TOTAL</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium text-center">STATUS</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contoh Data 1: Baru --}}
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-4 px-4 font-semibold text-navy-dark">#ORD-2310-001</td>
                        <td class="px-4 text-blue-medium">Budi Santoso</td>
                        <td class="px-4 text-blue-medium">26 Okt 2023</td>
                        <td class="px-4 font-semibold text-navy-dark">Rp 75.000</td>
                        <td class="px-4 text-center">
                            <span class="text-sm text-blue-700 bg-blue-100 px-3 py-1 rounded-full font-semibold">Baru</span>
                        </td>
                        <td class="px-4 text-center">
                            <button class="open-detail-modal text-blue-medium hover:text-navy-primary p-2 text-sm">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                    {{-- Contoh Data 2: Diproses --}}
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-4 px-4 font-semibold text-navy-dark">#ORD-2310-002</td>
                        <td class="px-4 text-blue-medium">Indah Sari</td>
                        <td class="px-4 text-blue-medium">26 Okt 2023</td>
                        <td class="px-4 font-semibold text-navy-dark">Rp 120.000</td>
                        <td class="px-4 text-center">
                            <span class="text-sm text-amber-700 bg-amber-100 px-3 py-1 rounded-full font-semibold">Diproses</span>
                        </td>
                        <td class="px-4 text-center">
                             <button class="open-detail-modal text-blue-medium hover:text-navy-primary p-2 text-sm">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                    {{-- Contoh Data 3: Selesai --}}
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-4 px-4 font-semibold text-navy-dark">#ORD-2310-003</td>
                        <td class="px-4 text-blue-medium">Rendy Pratama</td>
                        <td class="px-4 text-blue-medium">25 Okt 2023</td>
                        <td class="px-4 font-semibold text-navy-dark">Rp 50.000</td>
                        <td class="px-4 text-center">
                            <span class="text-sm text-status-success bg-green-100 px-3 py-1 rounded-full font-semibold">Selesai</span>
                        </td>
                        <td class="px-4 text-center">
                             <button class="open-detail-modal text-blue-medium hover:text-navy-primary p-2 text-sm">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                    {{-- Contoh Data 4: Dibatalkan --}}
                    <tr class="border-b hover:bg-slate-50">
                        <td class="py-4 px-4 font-semibold text-navy-dark">#ORD-2310-004</td>
                        <td class="px-4 text-blue-medium">Agus Setiawan</td>
                        <td class="px-4 text-blue-medium">25 Okt 2023</td>
                        <td class="px-4 font-semibold text-navy-dark">Rp 90.000</td>
                        <td class="px-4 text-center">
                            <span class="text-sm text-red-700 bg-red-100 px-3 py-1 rounded-full font-semibold">Dibatalkan</span>
                        </td>
                        <td class="px-4 text-center">
                             <button class="open-detail-modal text-blue-medium hover:text-navy-primary p-2 text-sm">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-sm text-blue-light">Menampilkan 4 dari 80 data</p>
            {{-- Komponen pagination di sini --}}
        </div>
    </div>
</div>

{{-- =============================================== --}}
{{-- MODAL DETAIL PESANAN --}}
{{-- =============================================== --}}
<div id="order-detail-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl transform transition-all">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-xl font-bold text-navy-dark">Detail Pesanan #ORD-2310-002</h3>
            <button class="close-modal text-2xl text-blue-light hover:text-navy-dark">&times;</button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Info Customer --}}
            <div>
                <h4 class="font-semibold text-navy-dark mb-2">Informasi Customer</h4>
                <div class="text-sm space-y-2 text-blue-medium">
                    <p><strong>Nama:</strong> Indah Sari</p>
                    <p><strong>Email:</strong> indah.s@example.com</p>
                    <p><strong>Telepon:</strong> 081234567891</p>
                    <p><strong>Alamat:</strong> Jl. Merdeka No. 10, Jakarta</p>
                </div>
            </div>
            {{-- Info Pesanan --}}
            <div>
                <h4 class="font-semibold text-navy-dark mb-2">Informasi Pesanan</h4>
                <div class="text-sm space-y-2 text-blue-medium">
                    <p><strong>Worker:</strong> Budi Santoso</p>
                    <p><strong>Tgl Pesan:</strong> 26 Okt 2023</p>
                    <p><strong>Pembayaran:</strong> COD</p>
                    <p><strong>Total Harga:</strong> <span class="font-bold text-navy-primary">Rp 120.000</span></p>
                </div>
            </div>
            
            {{-- Ubah Status --}}
            <div class="md:col-span-2">
                <label for="status" class="block text-sm font-semibold text-navy-dark mb-1">Ubah Status Pesanan</label>
                <select id="status" name="status" class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                    <option value="baru">Baru</option>
                    <option value="diproses" selected>Diproses</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex justify-end gap-4 p-6 bg-slate-50 rounded-b-2xl">
            <button class="close-modal bg-slate-200 text-slate-800 font-semibold py-2 px-4 rounded-lg hover:bg-slate-300">Tutup</button>
            <button class="bg-navy-primary text-white font-semibold py-2 px-4 rounded-lg hover:bg-opacity-90">Simpan Perubahan</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('order-detail-modal');
        const openModalButtons = document.querySelectorAll('.open-detail-modal');
        const closeModalButtons = document.querySelectorAll('.close-modal');

        const openModal = () => modal.classList.remove('hidden');
        const closeModal = () => modal.classList.add('hidden');

        openModalButtons.forEach(button => {
            button.addEventListener('click', openModal);
        });

        closeModalButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });

        // Klik di luar modal untuk menutup
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    });
</script>
@endpush