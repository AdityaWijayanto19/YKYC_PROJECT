@extends('layouts.worker')

{{-- Set judul halaman ini --}}
@section('title', 'Dashboard Worker')

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
Data ini mensimulasikan notifikasi yang akan diterima worker.
--}}
@php

    $notifications = [
        // Notifikasi Hari Ini
        (object) [
            'type' => 'order',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>',
            'color' => 'blue',
            'title' => 'Pesanan Baru Diterima!',
            'message' => 'Pesanan #SC-091123-005 dari customer Anisa Rahma.',
            'timestamp' => '2 menit yang lalu',
            'is_read' => false
        ],
        (object) [
            'type' => 'alert',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
            'color' => 'yellow',
            'title' => 'Rekomendasi Lokasi Mangkal',
            'message' => 'Terdeteksi keramaian di area Kampus Brawijaya. Pertimbangkan untuk pindah.',
            'timestamp' => '15 menit yang lalu',
            'is_read' => false
        ],
        (object) [
            'type' => 'admin',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.834 9.168-4.432" /></svg>',
            'color' => 'green',
            'title' => 'Pesan dari Admin',
            'message' => 'Pembagian rute penjemputan untuk area Jakarta Selatan sudah dirilis.',
            'timestamp' => '1 jam yang lalu',
            'is_read' => false
        ],
        // Notifikasi Kemarin
        (object) [
            'type' => 'order',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>',
            'color' => 'blue',
            'title' => 'Pesanan Selesai',
            'message' => 'Pesanan #SC-081123-021 telah ditandai selesai oleh Anda.',
            'timestamp' => 'Kemarin, 16:30',
            'is_read' => true
        ]
    ];
@endphp

<div class="container mx-auto max-w-2xl px-4 py-8">
    <!-- Header Halaman -->
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
        <button class="text-sm font-medium text-blue-600 hover:text-blue-800">Tandai semua sudah dibaca</button>
    </header>

    <!-- Filter Kategori -->
    <div class="mb-6 flex space-x-2 border-b">
        <button class="px-4 py-2 text-sm font-semibold text-blue-600 border-b-2 border-blue-600">Semua</button>
        <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Pesanan</button>
        <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Sistem</button>
        <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">Admin</button>
    </div>

    <!-- Daftar Notifikasi -->
    <div class="space-y-6">
        <!-- Grup Waktu: Hari Ini -->
        <div>
            <h2 class="text-xs font-semibold uppercase text-gray-500 mb-2">Hari Ini</h2>
            <div class="space-y-3">
                @foreach ($notifications as $notification)
                    @if ($notification->timestamp != 'Kemarin, 16:30')
                        <div
                            class="flex items-start p-4 rounded-lg {{ !$notification->is_read ? 'bg-white shadow' : 'bg-gray-50' }}">
                            <!-- Ikon -->
                            <div
                                class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center bg-{{$notification->color}}-100 text-{{$notification->color}}-600">
                                {!! $notification->icon !!}
                            </div>
                            <!-- Konten Teks -->
                            <div class="ml-4 flex-grow">
                                <p class="text-sm font-semibold text-gray-900">{{ $notification->title }}</p>
                                <p class="text-sm text-gray-600">{{ $notification->message }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notification->timestamp }}</p>
                            </div>
                            <!-- Indikator Belum Dibaca -->
                            @if (!$notification->is_read)
                                <div class="flex-shrink-0 ml-4 mt-1">
                                    <div class="h-2.5 w-2.5 rounded-full bg-blue-500"></div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Grup Waktu: Kemarin -->
        <div>
            <h2 class="text-xs font-semibold uppercase text-gray-500 mb-2">Kemarin</h2>
            <div class="space-y-3">
                @foreach ($notifications as $notification)
                    @if ($notification->timestamp == 'Kemarin, 16:30')
                        <div
                            class="flex items-start p-4 rounded-lg {{ !$notification->is_read ? 'bg-white shadow' : 'bg-gray-50' }}">
                            <!-- Ikon -->
                            <div
                                class="flex-shrink-0 h-10 w-10 rounded-full flex items-center justify-center bg-{{$notification->color}}-100 text-{{$notification->color}}-600">
                                {!! $notification->icon !!}
                            </div>
                            <!-- Konten Teks -->
                            <div class="ml-4 flex-grow">
                                <p class="text-sm font-semibold text-gray-900">{{ $notification->title }}</p>
                                <p class="text-sm text-gray-600">{{ $notification->message }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ $notification->timestamp }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection