@extends('layouts.worker')

@section('title', 'Dashboard Worker')

@section('content')
    @php
        // Bisa diambil dari database / session user
        $workerType = 'Keliling'; // ganti 'Mangkal' atau 'Keliling'
        $workerName = 'Budi Santoso';
        $isOnline = true;
    @endphp

    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <header class="mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ $workerName }}!</h1>

                <!-- Toggle Online/Offline -->
                <div class="flex items-center mt-4 md:mt-0">
                    <span class="mr-3 font-medium text-gray-700">{{ $isOnline ? 'Online' : 'Offline' }}</span>
                    <label for="status-toggle" class="inline-flex relative items-center cursor-pointer">
                        <input type="checkbox" id="status-toggle" class="sr-only peer" {{ $isOnline ? 'checked' : '' }}>
                        <div
                            class="w-14 h-8 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:bg-green-500 after:content-[''] after:absolute after:top-1 after:left-[4px] after:bg-white after:h-6 after:w-6 after:rounded-full after:transition-all">
                        </div>
                    </label>
                </div>
            </div>
        </header>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Kolom kiri (utama) -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Card Aktivitas -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    @if ($workerType == 'Mangkal')
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Mangkal</h2>
                        <button
                            class="w-full bg-green-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-600 flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Aktifkan Lokasi Mangkal</span>
                        </button>
                    @else
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Keliling</h2>
                        <button
                            class="w-full bg-blue-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-600 flex items-center justify-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            <span>Aktifkan Mode Keliling (GPS Tracking)</span>
                        </button>
                    @endif
                </div>

                <!-- Konten Dinamis -->
                @if ($workerType == 'Keliling')
                    <!-- Pesanan Aktif di atas -->
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Pesanan Aktif</h2>
                        <div class="space-y-3">
                            <div class="p-4 bg-blue-100 rounded-lg flex items-center justify-between">
                                <span class="font-medium text-gray-700">Pesanan #12345</span>
                                <span class="font-semibold text-blue-600">Dalam Proses</span>
                            </div>
                        </div>
                    </div>

                    <!-- Peta Tracking -->
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Tracking Lokasi</h2>
                        <div class="h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <p class="text-gray-500 text-center">Peta dengan tracking GPS akan ditampilkan di sini.</p>
                        </div>
                    </div>
                @else
                    <!-- Peta dulu -->
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Lokasi Mangkal Anda</h2>
                        <div class="h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <p class="text-gray-500 text-center">Peta lokasi mangkal akan ditampilkan di sini.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Kolom kanan -->
            <div class="lg:col-span-1 space-y-6">
                @if ($workerType == 'Mangkal')
                    <!-- Ringkasan Pesanan hanya untuk Mangkal -->
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                        <div class="grid grid-cols-3 gap-4 lg:grid-cols-1">
                            <div class="flex flex-col items-center lg:flex-row lg:justify-between p-4 bg-yellow-100 rounded-lg">
                                <span class="font-semibold text-yellow-800">Menunggu</span>
                                <span class="font-bold text-2xl text-yellow-900">5</span>
                            </div>
                            <div class="flex flex-col items-center lg:flex-row lg:justify-between p-4 bg-blue-100 rounded-lg">
                                <span class="font-semibold text-blue-800">Proses</span>
                                <span class="font-bold text-2xl text-blue-900">3</span>
                            </div>
                            <div class="flex flex-col items-center lg:flex-row lg:justify-between p-4 bg-green-100 rounded-lg">
                                <span class="font-semibold text-green-800">Selesai</span>
                                <span class="font-bold text-2xl text-green-900">12</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Aksi Cepat -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Aksi Cepat</h2>
                    <div class="space-y-3">
                        <button class="w-full bg-gray-800 text-white font-bold py-3 px-4 rounded-lg hover:bg-gray-700">
                            Mulai Aktivitas
                        </button>
                        <button class="w-full bg-gray-200 text-gray-800 font-bold py-3 px-4 rounded-lg hover:bg-gray-300">
                            Lihat Pesanan Aktif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection