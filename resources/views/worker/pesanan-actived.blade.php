@extends('layouts.worker')

{{-- Set judul halaman ini --}}
@section('title', 'Lokasi Gerobak Worker')

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
    Ubah $workerType menjadi 'Keliling' atau 'Mangkal' untuk melihat perbedaannya.
    --}}
    @php
        $workerType = 'Mangkal'; // Atau ganti menjadi 'Mangkal'

        $orders = [
            (object) [
                'id' => 'SC-081123-001',
                'customer' => 'Andi Wijaya',
                'phone' => '081234567890',
                'service' => 'Deep Clean (2 pasang)',
                'notes' => 'Tolong bagian sol bawah dibersihkan maksimal ya.',
                'location' => 'Jl. Merdeka No. 45, Jakarta Pusat',
                'status' => 'Waiting'
            ],
            (object) [
                'id' => 'SC-081123-002',
                'customer' => 'Daffa Ahmad',
                'phone' => '081234567890',
                'service' => 'Unyellowing (2 pasang)',
                'notes' => 'Upper nya sudah menguning.',
                'location' => 'Jl. Veteran No. 26, Jakarta Selatan',
                'status' => 'Payment'
            ],
            (object) [
                'id' => 'SC-081123-003',
                'customer' => 'Citra Lestari',
                'phone' => '081222333444',
                'service' => 'Quick Clean (1 pasang)',
                'notes' => 'Tidak ada catatan.',
                'location' => 'Stasiun Gondangdia, Pintu Selatan',
                'status' => 'In Progress'
            ],
            (object) [
                'id' => 'SC-081123-004',
                'customer' => 'Bambang Susilo',
                'phone' => '085678901234',
                'service' => 'Unyellowing (1 pasang)',
                'notes' => 'Sepatu Adidas Superstar, bagian mid-sole menguning.',
                'location' => 'Kantin FISIP, Universitas Indonesia',
                'status' => 'Selesai'
            ]
        ];

        // Fungsi untuk menentukan warna label status
        function getStatusClass($status)
        {
            switch ($status) {
                case 'Waiting':
                    return 'bg-yellow-100 text-yellow-800';
                case 'In Progress':
                    return 'bg-blue-100 text-blue-800';
                case 'Selesai':
                    return 'bg-green-100 text-green-800';
                case 'Payment':
                    return 'bg-red-100 text-red-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        }
    @endphp

    <div class="container mx-auto max-w-4xl px-4 py-8">

        <!-- Header -->
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Pesanan Aktif</h1>
            <p class="text-gray-600">Daftar semua pesanan yang perlu diproses.</p>
        </header>

        <!-- Filter/Tab Status -->
        <div class="mb-6 border-b border-gray-200">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                <a href="#" class="shrink-0 border-b-2 border-blue-500 px-1 pb-4 text-sm font-medium text-blue-600">
                    Semua
                </a>
                <a href="#"
                    class="shrink-0 border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                    Payment
                </a>
                <a href="#"
                    class="shrink-0 border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                    Waiting
                </a>
                <a href="#"
                    class="shrink-0 border-b-2 border-transparent px-1 pb-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">
                    In Progress
                </a>
            </nav>
        </div>

        <!-- Daftar Pesanan (Card List) -->
        <div class="space-y-4">
            @forelse ($orders as $order)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-lg">
                    <!-- Card Header -->
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Pesanan #{{ $order->id }}</h3>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ getStatusClass($order->status) }}">
                            {{ $order->status }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-4 space-y-4">
                        <!-- Detail Customer -->
                        <div>
                            <p class="text-sm text-gray-500">Customer</p>
                            <p class="font-semibold text-gray-900">{{ $order->customer }}</p>
                            <p class="text-sm text-gray-700">{{ $order->phone }}</p>
                        </div>

                        <!-- Detail Layanan -->
                        <div>
                            <p class="text-sm text-gray-500">Layanan</p>
                            <p class="font-semibold text-gray-900">{{ $order->service }}</p>
                        </div>

                        <!-- Detail Lokasi -->
                        <div>
                            <p class="text-sm text-gray-500">Lokasi</p>
                            <p class="text-gray-700">{{ $order->location }}</p>
                        </div>

                        <!-- Catatan -->
                        @if($order->notes != 'Tidak ada catatan.')
                            <div class="bg-gray-50 p-3 rounded-md">
                                <p class="text-sm text-gray-500">Catatan</p>
                                <p class="text-gray-700 italic">"{{ $order->notes }}"</p>
                            </div>
                        @endif
                    </div>

                    <!-- Card Footer (Aksi Dinamis) -->
                    <div class="p-4 bg-gray-50">
                        @if($workerType == 'Keliling')
                            <div class="flex flex-col sm:flex-row gap-3">
                                <button
                                    class="w-full sm:w-auto flex-grow bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center justify-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707l6 6a1 1 0 001.414-1.414L5 14.586V5.414l4.707-4.707a1 1 0 00-1.414-1.414l-6 6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Lihat Rute Customer</span>
                                </button>
                                @if($order->status == 'Waiting')
                                    <button
                                        class="w-full sm:w-auto bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600">Mulai
                                        Jemput</button>
                                @elseif($order->status == 'In Progress')
                                    <button
                                        class="w-full sm:w-auto bg-gray-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-700">Selesaikan</button>
                                @endif
                            </div>
                        @else {{-- Worker Mangkal --}}
                            <div class="flex flex-col sm:flex-row gap-3 items-center">
                                <div
                                    class="w-full sm:w-auto flex-grow text-center sm:text-left bg-green-100 text-green-800 text-sm font-semibold p-3 rounded-lg">
                                    Customer akan datang ke lokasi Anda.
                                </div>
                                @if($order->status == 'Waiting')
                                    <button
                                        class="w-full sm:w-auto bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">Mulai
                                        Kerjakan</button>
                                @elseif($order->status == 'In Progress')
                                    <button
                                        class="w-full sm:w-auto bg-gray-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-700">Selesaikan</button>
                                @elseif($order->status == 'Payment')
                                    <button
                                        class="w-full sm:w-auto bg-red-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700">Confirm Payment</button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <p class="text-gray-500">Tidak ada pesanan aktif saat ini.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection