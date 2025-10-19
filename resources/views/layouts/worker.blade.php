<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Worker App')</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('styles')

    <style>
        body {
            background-color: #f9fafb;
        }

        #profile-dropdown {
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans">

    @php
        $user = Auth::user();
        $worker = $user->worker ?? null;
    @endphp

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
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

                <div class="hidden md:flex items-center space-x-5">
                    {{-- Notifikasi --}}
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

                    {{-- Dropdown Profil --}}
                    <div class="relative">
                        <button id="profile-button"
                            class="block rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-gray-300 hover:border-blue-500"
                                src="{{ $worker && $worker->profile_image
                                    ? asset('storage/' . $worker->profile_image)
                                    : Avatar::create($worker?->name ?? Auth::user()->name)->toBase64() }}"
                                alt="Profil">
                        </button>

                        <div id="profile-dropdown"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-2 z-50 hidden origin-top-right">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-800">{{ $worker?->name ?? $user->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                            </div>
                            <a href="{{ route('worker.profil.show') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil Saya
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout.post') }}"
                                class="flex items-center px-4 py-2 text-sm text-danger hover:bg-red-50">
                                @csrf
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <a class="dropdown-item" href="{{ route('logout.post') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Tombol Mobile --}}
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

        {{-- Menu Mobile --}}
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

    <main class="py-4">
        @yield('content')
    </main>

    @stack('scripts')

    <script>
        // Toggle Mobile Menu
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

        // Dropdown Profil (mirip Customer)
        document.addEventListener('DOMContentLoaded', function () {
            const profileButton = document.getElementById('profile-button');
            const profileDropdown = document.getElementById('profile-dropdown');
            let isDropdownOpen = false;

            const toggleDropdown = (forceClose = false) => {
                if (forceClose || isDropdownOpen) {
                    profileDropdown.classList.add('hidden');
                    isDropdownOpen = false;
                } else {
                    profileDropdown.classList.remove('hidden');
                    isDropdownOpen = true;
                }
            };

            profileButton.addEventListener('click', function (event) {
                event.stopPropagation();
                toggleDropdown();
            });

            document.addEventListener('click', function (event) {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    toggleDropdown(true);
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    toggleDropdown(true);
                }
            });
        });
    </script>

</body>
</html>
