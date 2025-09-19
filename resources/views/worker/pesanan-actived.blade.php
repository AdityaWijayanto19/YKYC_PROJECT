@extends('layouts.worker')

@section('title', 'Lokasi Gerobak Worker')

@php
    // Ganti value ini untuk simulasi
    $workerType = 'Keliling'; // Atau 'Mangkal'

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

    // Ambil hanya 1 order untuk worker keliling (misal order pertama yang statusnya belum selesai)
    $activeKelilingOrder = collect($orders)->first(function ($o) {
        return in_array($o->status, ['Waiting', 'In Progress']);
    });

    // Fungsi warna label status
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

@section('content')
    <div class="container mx-auto max-w-4xl px-4 py-8">

        <!-- Header -->
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Pesanan Aktif</h1>
            <p class="text-gray-600">Daftar semua pesanan yang perlu diproses.</p>
        </header>

        @if ($workerType == 'Keliling')
            <!-- Khusus Worker Keliling: 1 Card Pesanan + Peta -->
            <div class="space-y-6">
                @if($activeKelilingOrder)
                    <!-- Card Pesanan -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-lg">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800">Pesanan #{{ $activeKelilingOrder->id }}</h3>
                            <span
                                class="text-xs font-semibold px-2.5 py-1 rounded-full {{ getStatusClass($activeKelilingOrder->status) }}">
                                {{ $activeKelilingOrder->status }}
                            </span>
                        </div>
                        <div class="p-4 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Customer</p>
                                <p class="font-semibold text-gray-900">{{ $activeKelilingOrder->customer }}</p>
                                <p class="text-sm text-gray-700">{{ $activeKelilingOrder->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Layanan</p>
                                <p class="font-semibold text-gray-900">{{ $activeKelilingOrder->service }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="text-gray-700">{{ $activeKelilingOrder->location }}</p>
                            </div>
                            @if($activeKelilingOrder->notes != 'Tidak ada catatan.')
                                <div class="bg-gray-50 p-3 rounded-md">
                                    <p class="text-sm text-gray-500">Catatan</p>
                                    <p class="text-gray-700 italic">"{{ $activeKelilingOrder->notes }}"</p>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 bg-gray-50 flex flex-col sm:flex-row gap-3">
                            <button
                                class="w-full sm:w-auto flex-grow bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                                Lihat Rute Customer
                            </button>
                            @if($activeKelilingOrder->status == 'Waiting')
                                <button
                                    class="w-full sm:w-auto flex-grow bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600">Mulai
                                    Jemput</button>
                            @elseif($activeKelilingOrder->status == 'In Progress')
                                <button
                                    class="w-full sm:w-auto bg-gray-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-700">Selesaikan</button>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500">Tidak ada pesanan aktif saat ini.</p>
                    </div>
                @endif
            </div>
        @else
            <!-- Worker Mangkal (pakai loop semua orders, kode lama tidak diubah) -->
            <div class="space-y-4">
                @forelse ($orders as $order)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-lg">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800">Pesanan #{{ $order->id }}</h3>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ getStatusClass($order->status) }}">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="p-4 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Customer</p>
                                <p class="font-semibold text-gray-900">{{ $order->customer }}</p>
                                <p class="text-sm text-gray-700">{{ $order->phone }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Layanan</p>
                                <p class="font-semibold text-gray-900">{{ $order->service }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="text-gray-700">{{ $order->location }}</p>
                            </div>
                            @if($order->notes != 'Tidak ada catatan.')
                                <div class="bg-gray-50 p-3 rounded-md">
                                    <p class="text-sm text-gray-500">Catatan</p>
                                    <p class="text-gray-700 italic">"{{ $order->notes }}"</p>
                                </div>
                            @endif
                        </div>
                        <div class="p-4 bg-gray-50 flex flex-col sm:flex-row gap-3 items-center">
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
                                    class="w-full sm:w-auto bg-red-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700">Confirm
                                    Payment</button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-500">Tidak ada pesanan aktif saat ini.</p>
                    </div>
                @endforelse
            </div>
        @endif

    </div>
@endsection