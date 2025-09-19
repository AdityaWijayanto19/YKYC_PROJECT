@extends('layouts.worker')

{{-- Set judul halaman ini --}}
@section('title', 'History Pesanan')

{{--
Jika ada CSS khusus untuk halaman ini, tambahkan di sini.
Contoh:
@push('styles')
<style>
    .custom-dashboard-style {
        ...
    }
</style>
@endpush
--}}

{{-- Mulai bagian konten --}}
@section('content')

{{--
SIMULASI DATA DARI CONTROLLER LARAVEL
Ini adalah contoh data pesanan yang sudah selesai.
--}}
@php
    $history = [
        (object) [
            'id' => 'SC-051123-015',
            'customer' => 'Rina Amelia',
            'service' => 'Deep Clean',
            'location' => 'Jl. Mawar No. 12',
            'date' => '2023-11-05',
            'status' => 'Selesai'
        ],
        (object) [
            'id' => 'SC-041123-011',
            'customer' => 'Fajar Nugraha',
            'service' => 'Quick Clean',
            'location' => 'Lobi Apartemen Cendana',
            'date' => '2023-11-04',
            'status' => 'Selesai'
        ],
        (object) [
            'id' => 'SC-031123-009',
            'customer' => 'Dewi Puspita',
            'service' => 'Unyellowing',
            'location' => 'Stasiun Gondangdia',
            'date' => '2023-11-03',
            'status' => 'Selesai'
        ],
        (object) [
            'id' => 'SC-011123-005',
            'customer' => 'Budi Santoso',
            'service' => 'Deep Clean',
            'location' => 'Kantin Vokasi UI',
            'date' => '2023-11-01',
            'status' => 'Selesai'
        ],
    ];
    $services = ['Deep Clean', 'Quick Clean', 'Unyellowing', 'Recoloring'];
@endphp

<div class="container mx-auto max-w-7xl px-4 py-8">

    <!-- Header -->
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Riwayat Pesanan Saya</h1>
        <p class="text-gray-600 mt-1">Lihat semua pesanan yang telah Anda selesaikan.</p>
    </header>

    <!-- Statistik Mini -->
    <section class="mb-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm font-medium text-gray-500">Pesanan Minggu Ini</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">12</p>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
            <p class="text-sm font-medium text-gray-500">Pesanan Bulan Ini</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">54</p>
        </div>
    </section>

    <!-- Panel Filter -->
    <section class="mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
            <!-- Filter Tanggal Mulai -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            </div>
            <!-- Filter Tanggal Akhir -->
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            </div>
            <!-- Filter Jenis Layanan -->
            <div>
                <label for="service_type" class="block text-sm font-medium text-gray-700">Jenis Layanan</label>
                <select id="service_type" name="service_type"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option>Semua Layanan</option>
                    @foreach ($services as $service)
                        <option>{{ $service }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Tombol Terapkan -->
            <div class="md:col-start-3 lg:col-start-4">
                <button
                    class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </section>

    <!-- Tabel Riwayat (Desktop) & Card List (Mobile) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Tampilan Tabel untuk Desktop -->
        <table class="min-w-full divide-y divide-gray-200 hidden md:table">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        Pesanan</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Customer</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Layanan</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl.
                        Selesai</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($history as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $order->customer }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $order->service }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">Tidak ada riwayat pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tampilan Card untuk Mobile -->
        <div class="md:hidden">
            @forelse ($history as $order)
                <div class="border-b border-gray-200">
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <p class="font-bold text-gray-800">#{{ $order->id }}</p>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="space-y-2 text-sm">
                            <p><span class="text-gray-500">Customer:</span> <span
                                    class="text-gray-800 font-medium">{{ $order->customer }}</span></p>
                            <p><span class="text-gray-500">Layanan:</span> <span
                                    class="text-gray-800 font-medium">{{ $order->service }}</span></p>
                            <p><span class="text-gray-500">Tanggal:</span> <span
                                    class="text-gray-800 font-medium">{{ $order->date }}</span></p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500">Tidak ada riwayat pesanan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection