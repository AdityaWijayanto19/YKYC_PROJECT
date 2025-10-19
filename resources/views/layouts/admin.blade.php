<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy-dark': '#021024',
                        'navy-primary': '#052659',
                        'blue-medium': '#5483B3',
                        'blue-light': '#7DA0CA',
                        'blue-pale': '#C1E8FF',
                        'status-success': '#10B981',
                        'status-pending': '#F59E0B',
                    }
                }
            }
        }
    </script>

    <style>
        .submenu {
            transition: max-height 0.3s ease-in-out;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100 font-sans">
    <x-toastify></x-toastify>
    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-white p-6 flex flex-col flex-shrink-0">
            <div class="flex items-center gap-2 mb-10">
                <div class="w-10 h-10 flex items-center justify-center">
                    <img src="/images/favicon-dark.svg" alt="Logo">
                </div>
                <span class="text-2xl font-bold text-navy-dark">AdminApp</span>
            </div>

            <nav class="flex-1 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->is('admin/dashboard*') ? 'bg-navy-primary text-white font-semibold' : 'text-blue-medium hover:bg-slate-100' }}">
                    <i class="fas fa-home w-5 text-center"></i> Dashboard
                </a>

                <div>
                    <button type="button"
                        class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 rounded-lg text-blue-medium hover:bg-slate-100 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-user-cog w-5 text-center"></i> Worker
                        </span>
                        <i class="dropdown-arrow fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="submenu max-h-0 overflow-hidden pl-8 space-y-2">
                        <a href="{{ route('admin.worker.index') }}"
                            class="block text-sm py-2 text-blue-medium hover:text-navy-dark {{ request()->is('admin/worker') ? 'font-bold text-navy-primary' : '' }}">Kelola
                            Worker</a>
                        <a href="{{ route('admin.worker.location-chart') }}"
                            class="block text-sm py-2 text-blue-medium hover:text-navy-dark {{ request()->is('admin/worker/location-chart') ? 'font-bold text-navy-primary' : '' }}">Lokasi
                            Worker</a>
                    </div>
                </div>

                <div>
                    <button type="button"
                        class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 rounded-lg text-blue-medium hover:bg-slate-100 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-users w-5 text-center"></i> Customer
                        </span>
                        <i class="dropdown-arrow fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    <div class="submenu max-h-0 overflow-hidden pl-8 space-y-2">
                        <a href="{{ route('admin.customer.index') }}"
                            class="block text-sm py-2 text-blue-medium hover:text-navy-dark {{ request()->is('admin/customer') ? 'font-bold text-navy-primary' : '' }}">Kelola
                            Customer</a>
                        <a href="{{ route('admin.service.index') }}"
                            class="block text-sm py-2 text-blue-medium hover:text-navy-dark {{ request()->is('admin/service') ? 'font-bold text-navy-primary' : '' }}">Kelola
                            Service</a>
                        <a href="{{ route('admin.promo.index') }}"
                            class="block text-sm py-2 text-blue-medium hover:text-navy-dark {{ request()->is('admin/promo') ? 'font-bold text-navy-primary' : '' }}">Kelola
                            Promo</a>
                        <a href="{{ route('admin.announcement.index') }}"
                            class="block text-sm py-2 text-blue-medium hover:text-navy-dark {{ request()->is('admin/announcement') ? 'font-bold text-navy-primary' : '' }}">Kelola
                            Pengumuman</a>
                    </div>
                </div>

                <a href="{{ route('admin.pesanan.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->is('admin/pesanan*') ? 'bg-navy-primary text-white font-semibold' : 'text-blue-medium hover:bg-slate-100' }}">
                    <i class="fas fa-shopping-bag w-5 text-center"></i> Pesanan
                </a>
                {{-- <div>
                    <button type="button"
                        class="dropdown-toggle w-full flex items-center justify-between gap-3 px-4 py-2 rounded-lg text-blue-medium hover:bg-slate-100 focus:outline-none">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-shopping-bag w-5 text-center"></i> Pesanan
                        </span>
                        <i class="dropdown-arrow fas fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>
                    Submenu untuk Pesanan
                    <div class="submenu max-h-0 overflow-hidden pl-8 space-y-2">
                        <a href="#" class="block text-sm py-2 text-blue-medium hover:text-navy-dark">Semua Pesanan</a>
                        <a href="#" class="block text-sm py-2 text-blue-medium hover:text-navy-dark">Pesanan Masuk</a>
                        <a href="#" class="block text-sm py-2 text-blue-medium hover:text-navy-dark">Pesanan
                            Dibatalkan</a>
                    </div>
                </div> --}}

                <div class="pt-6">
                    <h3 class="px-4 text-xs font-bold uppercase text-blue-light">System</h3>
                    <a href="{{ route('admin.peraturan.index') }}"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->is('admin/peraturan') ? 'bg-navy-primary text-white font-semibold' : 'text-blue-medium hover:bg-slate-100' }}">
                        <i class="fas fa-shield-alt w-5 text-center"></i> Peraturan
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

                dropdownToggles.forEach(toggle => {
                    const submenu = toggle.nextElementSibling;
                    const arrow = toggle.querySelector('.dropdown-arrow');
                    const hasActiveLink = submenu.querySelector('.font-bold.text-navy-primary');
                    
                    if (hasActiveLink) {
                        submenu.style.maxHeight = submenu.scrollHeight + "px";
                        arrow.classList.add('rotate-180');
                    }

                    toggle.addEventListener('click', () => {
                        const isOpen = submenu.style.maxHeight && submenu.style.maxHeight !== "0px";

                        if (isOpen) {
                            submenu.style.maxHeight = "0px";
                            arrow.classList.remove('rotate-180');
                        } else {
                            submenu.style.maxHeight = submenu.scrollHeight + "px";
                            arrow.classList.add('rotate-180');
                        }
                    });
                });
            });
        </script>
    @endpush

    @stack('scripts')
</body>

</html>