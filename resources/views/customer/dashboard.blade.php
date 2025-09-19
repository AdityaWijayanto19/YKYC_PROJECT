@extends('layouts.customer')

{{-- Push CSS khusus halaman ini --}}

{{-- Set judul halaman ini --}}
@section('title', 'Dashboard Worker')

@push('styles')
    <style>
        /* Styling khusus untuk halaman dashboard customer */
        .promo-carousel .swiper-slide img {
            border-radius: 1rem;
            /* Membuat sudut gambar carousel lebih melengkung */
        }
    </style>
@endpush

{{-- Mulai bagian konten --}}
@section('content')
    <!-- Content Area -->
    <main class="flex-1 overflow-y-auto bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-24">

            <!-- Header Section -->
            <section class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Halo, {{ $user->name ?? 'Pelanggan' }}!</h2>
                <p class="text-gray-500 mt-1">Siap membuat sepatumu bersih kembali?</p>
            </section>

            <!-- Carousel Promo Section -->
            <section class="mb-8">
                <div class="swiper promo-carousel rounded-2xl shadow-sm overflow-hidden">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2670&auto=format&fit=crop"
                                alt="Promo 2: Gratis Antar Jemput" class="w-full h-56 md:h-72 object-cover">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1511556532299-8f662fc26c06?q=80&w=2670&auto=format&fit=crop"
                                alt="Promo 3: Paket Bundling" class="w-full h-56 md:h-72 object-cover">
                        </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </section>


            <!-- Lacak Pesanan Saya -->
            <section class="mb-8">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Lacak Pesanan Saya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                    <a href="#"
                        class="bg-white p-5 rounded-2xl shadow-sm hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div class="bg-yellow-100 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium">Menunggu</p>
                                <p class="text-2xl font-bold text-gray-800">2</p>
                            </div>
                        </div>
                    </a>
                    <a href="#"
                        class="bg-white p-5 rounded-2xl shadow-sm hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div class="bg-blue-100 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium">Diproses</p>
                                <p class="text-2xl font-bold text-gray-800">1</p>
                            </div>
                        </div>
                    </a>
                    <a href="#"
                        class="bg-white p-5 rounded-2xl shadow-sm hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="flex items-start gap-4">
                            <div class="bg-green-100 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 font-medium">Siap Ambil</p>
                                <p class="text-2xl font-bold text-gray-800">3</p>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <!-- Peta & Riwayat -->
            <!-- Peta & Riwayat -->
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Kolom Peta (Tidak diubah, sebagai referensi tinggi) -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold text-gray-700">Temukan Gerobak Terdekat</h3>
                        <a href="{{ route('customer.locations') }}"
                            class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
                    </div>
                    <!-- Tinggi peta ini (`h-96`) menjadi patokan untuk card di sebelahnya -->
                    <div id="map" class="h-96 w-full rounded-lg z-10"></div>
                </div>

                <!-- ========================================================== -->
                <!-- CARD RIWAYAT (YANG SUDAH DIPERBAIKI DENGAN BENAR) -->
                <!-- ========================================================== -->
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4 flex-shrink-0">Riwayat Terbaru</h3>
                    <div class="flex-grow overflow-y-auto min-h-0">
                        <!-- Wrapper untuk memberikan sedikit padding bawah pada scrollbar -->
                        <div class="space-y-4 pr-2">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">Deep Clean - #ORD123</p>
                                    <p class="text-sm text-gray-500">15 Sep 2025</p>
                                </div>
                                <span
                                    class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Selesai</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">Quick Clean - #ORD121</p>
                                    <p class="text-sm text-gray-500">14 Sep 2025</p>
                                </div>
                                <span
                                    class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Selesai</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">Unyellowing - #ORD119</p>
                                    <p class="text-sm text-gray-500">12 Sep 2025</p>
                                </div>
                                <span
                                    class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Selesai</span>
                            </div>
                            <!-- Data Tambahan untuk Menunjukkan Scroll Bekerja -->
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">Repaint - #ORD115</p>
                                    <p class="text-sm text-gray-500">10 Sep 2025</p>
                                </div>
                                <span
                                    class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Selesai</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">Deep Clean - #ORD112</p>
                                    <p class="text-sm text-gray-500">8 Sep 2025</p>
                                </div>
                                <span
                                    class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Selesai</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-gray-800">Unyellowing - #ORD109</p>
                                    <p class="text-sm text-gray-500">5 Sep 2025</p>
                                </div>
                                <span
                                    class="px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Selesai</span>
                            </div>                          
                        </div>
                    </div>

                    <!-- DIV 2: Area Link "Lihat Semua" yang Tetap di Bawah (tidak ikut scroll) -->
                    <div class="pt-4 mt-4 border-t border-gray-200 text-center flex-shrink-0">
                        <a href="{{ route('customer.history') }}"
                            class="text-primary hover:underline font-semibold text-sm">
                            Lihat Semua Riwayat
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
{{-- Akhir bagian konten --}}

@push('scripts')
    <!-- Swiper.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ========== Swiper.js Carousel Initialization ==========
            const swiper = new Swiper('.promo-carousel', {
                // Optional parameters
                loop: true, // Membuat carousel berputar tanpa henti
                autoplay: {
                    delay: 4000, // Pindah slide setiap 4 detik
                    disableOnInteraction: false, // Autoplay tidak berhenti setelah interaksi user
                },

                // If we need pagination
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },

                // Navigation arrows
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });


            // ========== Leaflet.js Map Initialization ==========
            const mapElement = document.getElementById('map');
            if (mapElement) {
                const map = L.map('map').setView([-7.966737054356289, 112.63246382330945], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© YKYc'
                }).addTo(map);

                const locations = [
                    { lat: -8.170114494091404, lng: 112.68353990616373, name: 'Universitas Brawijaya' },
                    { lat: -6.1751, lng: 106.8650, name: 'Gerobak Stasiun Gambir' },
                    { lat: -6.2415, lng: 106.8242, name: 'Gerobak Blok M Square' }
                ];

                const cartIcon = L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/3721/3721838.png',
                    iconSize: [40, 40],
                    iconAnchor: [20, 40],
                    popupAnchor: [0, -40]
                });

                locations.forEach(loc => {
                    L.marker([loc.lat, loc.lng], { icon: cartIcon }).addTo(map)
                        .bindPopup(`<b>${loc.name}</b><br>Aktif sekarang!`);
                });
            }
        });
    </script>
@endpush