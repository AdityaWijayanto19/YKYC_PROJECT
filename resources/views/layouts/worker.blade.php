<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul halaman akan dinamis, dengan judul default jika tidak di-set --}}
    <title>@yield('title', 'Worker App')</title>

    <!-- Impor Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{--
    Area untuk CSS tambahan yang spesifik per halaman.
    Gunakan @push('styles') di halaman anak untuk menambahkan stylesheet.
    --}}
    @stack('styles')

    <style>
        /* Anda bisa menambahkan custom CSS global di sini */
        body {
            background-color: #f7fafc;
        }
    </style>
</head>

<body class="font-sans">

    @php
        $unreadCount = 3;
        $worker = (object) [
            'type' => 'Keliling', // atau 'Mangkal'
        ];
    @endphp

    <!-- Navigasi Utama -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto max-w-7xl px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo Aplikasi -->
                <div class="text-xl font-bold text-gray-800">
                    <a href="#">WorkerApp</a>
                    <span
                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full mt-1 {{ $worker->type == 'Keliling' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                        {{ $worker->type }}
                    </span>
                </div>

                <!-- Menu Navigasi -->
                <div class="hidden md:flex items-center space-x-6">
                    {{--
                    Ganti '#' dengan route Laravel yang sesuai, contoh: route('worker.dashboard')
                    Class 'request()->is()' digunakan untuk menandai link yang aktif.
                    --}}
                    <a href="{{ route('worker.dashboard') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/dashboard') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Dashboard</a>
                    <a href="{{ route('worker.pesanan.history') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/history-pesanan') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Riwayat
                        Pesanan</a>
                    <a href="{{ route('worker.location.chart') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/location-chart') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Lokasi
                        Gerobak</a>
                    <a href="{{ route('worker.notifications') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/notifications') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Notifikasi</a>
                    <a href="{{ route('worker.pesanan.actived') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/pesanan-actived') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Pesanan
                        Aktif</a>
                    <a href="{{ route('worker.profil') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/profil') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Profil</a>
                </div>

                <!-- Menu User & Notifikasi (BAGIAN YANG DIPERBAIKI) -->
                <div class="hidden md:flex items-center space-x-5">
                    <!-- Tombol Notifikasi -->
                    <div class="relative">
                        <button class="text-gray-600 hover:text-gray-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        {{-- Badge notifikasi diposisikan absolut relatif terhadap div ini --}}
                        @if ($unreadCount > 0)
                            <span
                                class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white">{{ $unreadCount }}</span>
                        @endif
                    </div>

                    <!-- Menu User (Contoh) -->
                    <div class="hidden md:block">
                        <a href="#" class="text-gray-600 hover:text-gray-800">Profil Saya</a>
                    </div>

                    <!-- Tombol Menu Mobile -->
                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Menu Mobile (Tersembunyi secara default) -->
            <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2">
                <a href="#" class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Dashboard</a>
                <a href="#" class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Riwayat Pesanan</a>
                <a href="#" class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Profil Saya</a>
            </div>
    </nav>


    <!-- Konten Utama Halaman -->
    <main>
        @yield('content')
    </main>

    {{--
    Area untuk script JavaScript tambahan yang spesifik per halaman.
    Gunakan @push('scripts') di halaman anak untuk menambahkan script.
    --}}
    @stack('scripts')

    <script>
        // Script untuk toggle menu mobile
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>