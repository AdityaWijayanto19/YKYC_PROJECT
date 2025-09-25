<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>@yield('title', 'Customer App')</title>

    @stack('styles')

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#4F46E5', // Indigo-600 (Aksen Baru)
                        'secondary': '#6B7280', // Gray-500
                        'success': '#10B981', // Emerald-500
                        'warning': '#F59E0B', // Amber-500
                        'danger': '#EF4444', // Red-500
                        'light': '#F9FAFB', // Gray-5
                        'dark': '#1F2937', // Gray-800
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Leaflet.js for Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Swiper.js for Carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Padding bawah untuk konten agar tidak tertutup bottom bar */
        .pb-24 {
            padding-bottom: 6rem;
        }

        /* Styling untuk panah navigasi Swiper */
        .swiper-button-next,
        .swiper-button-prev {
            color: #4F46E5;
            /* Menggunakan warna primer baru */
            transition: background-color 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 50%;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px;
        }

        /* Transisi untuk dropdown */
        #profile-dropdown {
            transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
        }
    </style>
</head>

<body class="bg-light font-sans">
    <x-sidebar-customer></x-sidebar-customer>

    <!-- Wrapper Utama -->
    <div class="flex flex-col h-screen">
        <!-- Header Atas -->
        <header class="flex justify-between items-center px-6 py-3 bg-white shadow-sm z-20">
            <!-- Logo di Kiri -->
            <a href="#">
                <img class="h-10" src="/images/favicon-dark.svg">
            </a>

            <!-- Grup Tombol di Kanan -->
            <div class="flex items-center space-x-5">
                <!-- Tombol Notifikasi -->
                <button
                    class="p-2 rounded-full text-gray-500 hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    <span class="sr-only">Lihat Notifikasi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>

                <!-- Ikon Profil Dropdown -->
                <div class="relative">
                    <!-- Tombol Ikon Profil -->
                    <button id="profile-button"
                        class="block rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <img class="h-10 w-10 rounded-full object-cover" src="https://i.ibb.co.com/DHKNjW33/aditya.jpg"
                            alt="Foto Profil">
                    </button>

                    <!-- Menu Dropdown -->
                    <div id="profile-dropdown"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-2 z-50 hidden origin-top-right">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">Aditya Pratama</p>
                            <p class="text-xs text-gray-500 truncate">aditya.pratama@example.com</p>
                        </div>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profil Saya
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.096 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pengaturan
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
        </header>

        <!-- Di sinilah konten dari file dashboard.blade.php akan dimasukkan -->
        <main class="flex-1 overflow-y-auto bg-light p-6">
            @yield('content')
        </main>

    </div>

    @stack('scripts')

    <!-- Script untuk toggle menu dropdown profil -->
    <script>
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