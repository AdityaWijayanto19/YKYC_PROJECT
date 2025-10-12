<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Worker App')</title>
    <!-- Di dalam <head> -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Sebelum </body> -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('styles')

    <style>
        body {
            background-color: #f9fafb;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans">

    @php
        $user = Auth::user();
        $worker = $user->worker ?? null; // Pastikan relasi sudah benar
    @endphp

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">

                <!-- Kiri: Logo -->
                <div>
                    <a href="{{ route('worker.dashboard') }}" class="text-xl font-bold text-gray-800">
                        Ya Kotor Ya Cuci
                    </a>
                    @if ($worker)
                        <span
                            class="ml-2 text-xs px-2 py-1 rounded-full 
                                        {{ $worker->worker_type == 'Keliling' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ $worker->worker_type }}
                        </span>
                    @endif
                </div>

                <!-- Tengah: Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('worker.dashboard') }}"
                        class="{{ request()->is('worker/dashboard') ? 'text-blue-600 border-b-2 border-blue-500' : 'text-gray-600 hover:text-blue-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('worker.pesanan-actived.active') }}"
                        class="{{ request()->is('worker/pesanan-actived*') ? 'text-blue-600 border-b-2 border-blue-500' : 'text-gray-600 hover:text-blue-600' }}">
                        Pesanan Aktif
                    </a>

                    <a href="{{ route('worker.location.chart') }}"
                        class="{{ request()->is('worker/location-chart') ? 'text-blue-600 border-b-2 border-blue-500' : 'text-gray-600 hover:text-blue-600' }}">
                        Lokasi Gerobak
                    </a>

                    <a href="{{ route('worker.history-pesanan') }}"
                        class="{{ request()->is('worker/history-pesanan') ? 'text-blue-600 border-b-2 border-blue-500' : 'text-gray-600 hover:text-blue-600' }}">
                        Riwayat Pesanan
                    </a>
                </div>

                <!-- Kanan: Notifikasi & Profil -->
                <div class="hidden md:flex items-center space-x-5">
                    <!-- Notifikasi (statis dulu) -->
                    <div class="relative group">
                        <button class="relative text-gray-600 hover:text-gray-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span
                                class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white">3</span>
                        </button>

                        <!-- Dropdown notifikasi -->
                        <div
                            class="absolute right-0 mt-3 w-80 bg-white shadow-lg rounded-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-300">
                            <div class="p-3 border-b font-semibold text-gray-700">Notifikasi Baru</div>
                            <ul class="max-h-96 overflow-y-auto divide-y divide-gray-100">
                                <li class="px-4 py-3 hover:bg-gray-50">
                                    <p class="text-sm font-medium text-gray-800">Pesanan baru masuk</p>
                                    <p class="text-xs text-gray-600">5 menit yang lalu</p>
                                </li>
                                <li class="px-4 py-3 hover:bg-gray-50">
                                    <p class="text-sm font-medium text-gray-800">Pesanan selesai</p>
                                    <p class="text-xs text-gray-600">10 menit yang lalu</p>
                                </li>
                                <li class="px-4 py-3 hover:bg-gray-50">
                                    <p class="text-sm font-medium text-gray-800">Saldo kamu bertambah Rp10.000</p>
                                    <p class="text-xs text-gray-600">1 jam yang lalu</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Profil -->
                    <a href="{{ route('worker.profil.show') }}">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-300 hover:border-blue-500"
                            src="{{ $worker && $worker->profile_image
    ? asset('storage/' . $worker->profile_image)
    : Avatar::create($worker?->name ?? Auth::user()->name)->toBase64() }}" alt="Profil">
                    </a>
                </div>

                <!-- Tombol mobile -->
                <div class="flex md:hidden items-center space-x-4">
                    <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu"
            class="max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out md:hidden bg-white px-4 space-y-2 border-t">
            <a href="{{ route('worker.dashboard') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Dashboard</a>
            <a href="{{ route('worker.pesanan-actived.active') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Pesanan Aktif</a>
            <a href="{{ route('worker.location.chart') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Lokasi Gerobak</a>
            <a href="{{ route('worker.history-pesanan') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Riwayat Pesanan</a>
        </div>
    </nav>

    <!-- Konten halaman -->
    <main class="py-4">
        @yield('content')
    </main>

    @stack('scripts')

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('max-h-0');
                mobileMenu.classList.toggle('opacity-0');
                mobileMenu.classList.toggle('max-h-screen');
                mobileMenu.classList.toggle('opacity-100');
                mobileMenu.classList.toggle('py-4');
            });
        }
    </script>

</body>

</html>