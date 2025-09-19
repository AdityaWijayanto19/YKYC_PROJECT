@extends('layouts.customer')

{{-- Push CSS khusus halaman ini --}}

{{-- Set judul halaman ini --}}
@section('title', 'Status Pesanan - Ya Kotor Ya Cuci')

{{-- Mulai bagian konten --}}
@section('content')

    {{-- DUMMY DATA: Di controller, Anda akan mengambil data ini dari database --}}
    @php
        $active_orders = [
            [
                'id' => 'YKYC-221',
                'service' => 'Deep Clean',
                'date' => '16 Sep 2025',
                'status' => 'In Progress',
                'worker' => 'Gerobak Senayan Park',
                'location' => ['lat' => -6.2297, 'lng' => 106.8093]
            ],
            [
                'id' => 'YKYC-219',
                'service' => 'Quick Clean',
                'date' => '15 Sep 2025',
                'status' => 'Waiting',
                'worker' => 'Gerobak Blok M Square',
                'location' => null
            ],
            [
                'id' => 'YKYC-215',
                'service' => 'Unyellowing + Deep Clean',
                'date' => '14 Sep 2025',
                'status' => 'Ready for Pickup',
                'worker' => 'Gerobak Stasiun Gambir',
                'location' => ['lat' => -6.1751, 'lng' => 106.8650]
            ],
        ];
    @endphp

    <div class="flex h-screen bg-gray-100">
        <x-sidebar-customer></x-sidebar-customer>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar (mobile) -->
            <header class="flex justify-between items-center p-4 bg-white border-b md:hidden">
                <h1 class="text-xl font-bold text-primary">Status Pesanan</h1>
                <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                        </path>
                    </svg>
                </button>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Status Pesanan Aktif Anda</h2>
                    <p class="text-gray-500 mb-8">Lacak progres pembersihan sepatumu di sini.</p>

                    <!-- Order List -->
                    <div class="space-y-6">
                        @forelse ($active_orders as $order)
                            <div class="bg-white p-6 rounded-lg shadow-md transition hover:shadow-xl">
                                <div class="flex flex-wrap justify-between items-center gap-4">
                                    <!-- Order Details -->
                                    <div class="flex-1 min-w-[250px]">
                                        <div class="flex items-center gap-4">
                                            <div class="p-3 bg-primary/10 rounded-lg">
                                                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2 1M4 7l2-1M4 7v2.5M12 21.5V12M12 12l-4.21-6.315A1 1 0 018.63 4.5h6.74a1 1 0 01.84.185L12 12z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-lg text-gray-800">{{ $order['service'] }}</p>
                                                <p class="text-sm text-gray-500">ID: {{ $order['id'] }} &bull;
                                                    {{ $order['date'] }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-4 pl-14">
                                            <p class="text-sm text-gray-600">Dikerjakan oleh: <span
                                                    class="font-semibold">{{ $order['worker'] }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Status & Action -->
                                    <div class="flex flex-col sm:flex-row items-center gap-4">
                                        <!-- Status Badge -->
                                        @php
                                            $statusClass = '';
                                            if ($order['status'] == 'Waiting')
                                                $statusClass = 'bg-warning/20 text-warning-800';
                                            elseif ($order['status'] == 'In Progress')
                                                $statusClass = 'bg-primary/20 text-primary-800';
                                            elseif ($order['status'] == 'Ready for Pickup')
                                                $statusClass = 'bg-success/20 text-success-800';
                                        @endphp
                                        <span class="px-4 py-1.5 text-sm font-semibold rounded-full {{ $statusClass }}">
                                            {{ $order['status'] }}
                                        </span>

                                        <!-- Action Button -->
                                        @if ($order['status'] == 'In Progress' || $order['status'] == 'Ready for Pickup')
                                            {{-- Mengubah <button> menjadi <a> yang diarahkan ke route tracking --}}
                                                    {{-- Kita mengirimkan ID pesanan sebagai parameter --}}
                                                    <a href="{{ route('customer.tracking', ['order' => $order['id']]) }}"
                                                        class="text-white bg-primary hover:bg-blue-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center gap-2">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        </svg>
                                                        Lacak Gerobak
                                                    </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white p-8 text-center rounded-lg shadow-md">
                                <p class="text-gray-600">Anda belum memiliki pesanan aktif saat ini.</p>
                                <a href="{{-- route('order.create') --}}"
                                    class="mt-4 inline-block bg-primary text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition">Buat
                                    Pesanan Sekarang</a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal for Map Tracking -->
    <div id="map-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
            <div class="p-4 border-b flex justify-between items-center">
                <h3 id="modal-title" class="text-xl font-semibold">Lokasi Gerobak</h3>
                <button id="close-modal" class="text-gray-500 hover:text-gray-800">&times;</button>
            </div>
            <div class="p-4">
                <div id="track-map" class="h-96 w-full rounded z-10"></div>
            </div>
        </div>
    </div>
@endsection
{{-- Akhir bagian konten --}}

@push('scripts')
     <script>
        document.addEventListener('DOMContentLoaded', function () {
            // ========== Mobile Menu Toggle ==========
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');

            mobileMenuButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });

            // ========== Map Modal Logic ==========
            const mapModal = document.getElementById('map-modal');
            const closeModalButton = document.getElementById('close-modal');
            const trackButtons = document.querySelectorAll('.track-button');
            const modalTitle = document.getElementById('modal-title');
            let map = null; // Variable to hold map instance
            let marker = null; // Variable to hold marker instance

            const openModal = (lat, lng, workerName) => {
                if (!lat || !lng) {
                    alert('Lokasi untuk gerobak ini tidak tersedia.');
                    return;
                }

                modalTitle.textContent = `Lokasi ${workerName}`;
                mapModal.classList.remove('hidden');

                // Initialize map if it hasn't been, otherwise set new view
                if (!map) {
                    map = L.map('track-map').setView([lat, lng], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);
                } else {
                    map.setView([lat, lng], 15);
                }

                // Add or move marker
                if (!marker) {
                    marker = L.marker([lat, lng]).addTo(map);
                } else {
                    marker.setLatLng([lat, lng]);
                }
                marker.bindPopup(`<b>${workerName}</b>`).openPopup();

                // IMPORTANT: Invalidate map size after modal is shown to prevent gray tiles
                setTimeout(() => map.invalidateSize(), 10);
            };

            const closeModal = () => {
                mapModal.classList.add('hidden');
            };

            trackButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const lat = button.dataset.lat;
                    const lng = button.dataset.lng;
                    const worker = button.dataset.worker;
                    openModal(lat, lng, worker);
                });
            });

            closeModalButton.addEventListener('click', closeModal);
            // Close modal if user clicks outside the content
            mapModal.addEventListener('click', (event) => {
                if (event.target === mapModal) {
                    closeModal();
                }
            });
        });
    </script>
@endpush