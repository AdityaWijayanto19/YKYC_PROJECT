<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>@yield('title', 'Worker App')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')

    <style>
        body {
            background-color: #f7fafc;
        }

        /* Animasi dropdown */
        .dropdown-enter {
            opacity: 0;
            transform: translateY(-10px);
        }

        .dropdown-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease-in-out;
        }

        .dropdown-leave {
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown-leave-active {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.2s ease-in-out;
        }
    </style>
</head>

<body class="font-sans">

    @php
        $unreadCount = 6;
        $notifications = [
            ['title' => 'Pesanan Baru', 'message' => 'Kamu punya pesanan baru dari pelanggan.'],
            ['title' => 'Pesanan Dibatalkan', 'message' => 'Pesanan #25091 dibatalkan pelanggan.'],
            ['title' => 'Pesanan Selesai', 'message' => 'Pesanan #25090 sudah selesai.'],
            ['title' => 'Promo Hari Ini', 'message' => 'Dapatkan bonus tambahan dari hasil kerja hari ini!'],
            ['title' => 'Update Aplikasi', 'message' => 'Ada pembaruan fitur baru di WorkerApp.'],
            ['title' => 'Selesaikan Aktivitas', 'message' => 'Jangan lupa tutup aktivitas harianmu.'],
        ];
        $worker = (object) [
            'type' => 'Keliling',
            'profile_image' => 'https://i.ibb.co.com/BHs9DfNK/2025-02-16-17-23-IMG-0201.jpg',
        ];
      @endphp

    <!-- Navigasi -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto max-w-7xl px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div>
                    <a href="#" class="text-xl font-bold text-gray-800">WorkerApp</a>
                    <span
                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full mt-1 {{ $worker->type == 'Keliling' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                        {{ $worker->type }}
                    </span>
                </div>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('worker.dashboard') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/dashboard') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Dashboard</a>
                    <a href="{{ route('worker.pesanan.actived') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/pesanan-actived') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Pesanan
                        Aktif</a>
                    <a href="{{ route('worker.location.chart') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/location-chart') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Lokasi
                        Gerobak</a>
                    <a href="{{ route('worker.pesanan.history') }}"
                        class="text-gray-600 hover:text-blue-600 font-medium pb-1 border-b-2 {{ request()->is('worker/history-pesanan') ? 'border-blue-500 text-blue-600' : 'border-transparent' }}">Riwayat
                        Pesanan</a>
                </div>

                <!-- Notifikasi + Profil -->
                <div class="hidden md:flex items-center space-x-5">
                    <!-- Notifikasi -->
                    <div class="relative group">
                        <button id="notif-btn" class="relative text-gray-600 hover:text-gray-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if ($unreadCount > 0)
                                <span
                                    class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white">{{ $unreadCount }}</span>
                            @endif
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="absolute right-0 mt-3 w-80 bg-white shadow-lg rounded-lg border border-gray-200 opacity-0 invisible transition duration-300">
                            <div class="p-3 border-b font-semibold text-gray-700">Notifikasi Baru</div>
                            <ul class="max-h-96 overflow-y-auto divide-y divide-gray-100">
                                @foreach (array_slice($notifications, 0, 5) as $notif)
                                    <li class="px-4 py-3 hover:bg-gray-50">
                                        <p class="text-sm font-medium text-gray-800">{{ $notif['title'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $notif['message'] }}</p>
                                    </li>
                                @endforeach
                            </ul>
                            @if (count($notifications) > 5)
                                <div class="text-center py-2">
                                    <a href="{{ route('worker.notifications') }}"
                                        class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profil -->
                    <a href="{{ route('worker.profil') }}">
                        <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-300 hover:border-blue-500"
                            src="{{ $worker->profile_image }}" alt="Profil">
                    </a>
                </div>

                <!-- Mobile -->
                <div class="flex md:hidden items-center space-x-4">
                    <!-- Notifikasi Mobile -->
                    <div class="relative">
                        <button id="notif-btn-mobile"
                            class="relative text-gray-600 hover:text-gray-800 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            @if ($unreadCount > 0)
                                <span
                                    class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white">{{ $unreadCount }}</span>
                            @endif
                        </button>

                        <!-- Dropdown Mobile -->
                        <div id="notif-dropdown-mobile"
                            class="absolute right-0 mt-3 w-72 bg-white shadow-lg rounded-lg border border-gray-200 hidden">
                            <div class="p-3 border-b font-semibold text-gray-700">Notifikasi Baru</div>
                            <ul class="max-h-96 overflow-y-auto divide-y divide-gray-100">
                                @foreach (array_slice($notifications, 0, 5) as $notif)
                                    <li class="px-4 py-3 hover:bg-gray-50">
                                        <p class="text-sm font-medium text-gray-800">{{ $notif['title'] }}</p>
                                        <p class="text-xs text-gray-600">{{ $notif['message'] }}</p>
                                    </li>
                                @endforeach
                            </ul>
                            @if (count($notifications) > 5)
                                <div class="text-center py-2">
                                    <a href="{{ route('worker.notifications') }}"
                                        class="text-blue-600 text-sm font-medium hover:underline">Lihat Semua</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Profil -->
                    <a href="{{ route('worker.profil') }}">
                        <img class="h-9 w-9 rounded-full object-cover border-2 border-gray-300"
                            src="{{ $worker->profile_image }}" alt="Profil">
                    </a>

                    <!-- Hamburger -->
                    <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobile-menu"
            class="max-h-0 opacity-0 overflow-hidden transition-all duration-500 ease-in-out md:hidden bg-white px-4 space-y-2 border-t">
            <a href="{{ route('worker.dashboard') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Dashboard</a>
            <a href="{{ route('worker.pesanan.history') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Riwayat Pesanan</a>
            <a href="{{ route('worker.location.chart') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Lokasi Gerobak</a>
            <a href="{{ route('worker.pesanan.actived') }}"
                class="block text-gray-700 hover:bg-gray-100 rounded-md py-2 px-3">Pesanan Aktif</a>
        </div>
    </nav>

    <!-- Konten -->
    <main>
        @yield('content')
    </main>

    @stack('scripts')

    <script>
        // Mobile menu toggle
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

        // --- DESKTOP: dropdown notifikasi ---
        const notifBtn = document.getElementById('notif-btn');
        const notifDropdown = notifBtn?.nextElementSibling;

        if (notifBtn && notifDropdown) {
            let timeout;

            notifBtn.addEventListener('mouseenter', () => {
                clearTimeout(timeout);
                notifDropdown.classList.remove('opacity-0', 'invisible');
                notifDropdown.classList.add('opacity-100', 'visible');
            });

            notifDropdown.addEventListener('mouseenter', () => {
                clearTimeout(timeout);
                notifDropdown.classList.remove('opacity-0', 'invisible');
                notifDropdown.classList.add('opacity-100', 'visible');
            });

            const closeDropdown = () => {
                timeout = setTimeout(() => {
                    notifDropdown.classList.remove('opacity-100', 'visible');
                    notifDropdown.classList.add('opacity-0', 'invisible');
                }, 200);
            };

            notifBtn.addEventListener('mouseleave', closeDropdown);
            notifDropdown.addEventListener('mouseleave', closeDropdown);
        }

        // --- MOBILE: toggle notif dengan klik ---
        const notifBtnMobile = document.getElementById('notif-btn-mobile');
        const notifDropdownMobile = document.getElementById('notif-dropdown-mobile');

        if (notifBtnMobile && notifDropdownMobile) {
            notifBtnMobile.addEventListener('click', (e) => {
                e.stopPropagation();
                notifDropdownMobile.classList.toggle('hidden');
            });

            // Tutup kalau klik di luar
            document.addEventListener('click', (e) => {
                if (!notifBtnMobile.contains(e.target) && !notifDropdownMobile.contains(e.target)) {
                    notifDropdownMobile.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>