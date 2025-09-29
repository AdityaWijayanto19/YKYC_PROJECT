@extends('layouts.customer')

@section('title', 'Status Pesanan - Ya Kotor Ya Cuci')

@section('content')
    {{-- ... (kode pembuka <div class="flex h-screen ..."> sampai <main>) ... --}}

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto">
                    {{-- Tambahkan ini untuk menampilkan pesan dari redirect (contoh: 'sudah lunas') --}}
                    @if (session('info'))
                        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                            <p>{{ session('info') }}</p>
                        </div>
                    @endif

                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Status Pesanan Aktif Anda</h2>
                    <p class="text-gray-500 mb-8">Lacak progres pembersihan sepatumu di sini.</p>

                    <!-- Order List -->
                    <div class="space-y-6">
                        @forelse ($active_orders as $order)
                            {{-- ID unik untuk setiap kartu pesanan agar bisa di-update oleh JS --}}
                            <div id="order-card-{{ $order->id }}"
                                class="bg-white p-6 rounded-lg shadow-md transition hover:shadow-xl">
                                <div class="flex flex-wrap justify-between items-center gap-4">
                                    <!-- Order Details -->
                                    <div class="flex-1 min-w-[250px]">
                                        <div class="flex items-center gap-4">
                                            {{-- ... (ikon SVG) ... --}}
                                            <div>
                                                {{-- Menggunakan relasi untuk mengambil nama service --}}
                                                <p class="font-bold text-lg text-gray-800">{{ $order->service->name }}</p>
                                                <p class="text-sm text-gray-500">ID: {{ $order->order_id }} &bull;
                                                    {{ $order->created_at->format('d M Y') }}
                                                </p>

                                                {{-- Badge Status Pembayaran dengan ID unik --}}
                                                <div id="payment-status-{{ $order->id }}" class="mt-1">
                                                    @if ($order->payment_status == 'paid')
                                                        <span
                                                            class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                                    @else
                                                        <span
                                                            class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu
                                                            Pembayaran</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ... (dikerjakan oleh) ... --}}
                                    </div>

                                    <!-- Status & Action -->
                                    <div id="action-buttons-{{ $order->id }}"
                                        class="flex flex-col sm:flex-row items-center gap-4">
                                        <!-- Status Pengerjaan -->
                                        @php
                                            $status = strtolower($order->status);
                                            $statusClass = 'bg-gray-200 text-gray-800'; // Default
                                            if (in_array($status, ['diproses', 'in progress']))
                                                $statusClass = 'bg-blue-100 text-blue-800';
                                            elseif ($status === 'ready for pickup')
                                                $statusClass = 'bg-green-100 text-green-800';
                                        @endphp
                                        <span
                                            class="px-4 py-1.5 text-sm font-semibold rounded-full capitalize {{ $statusClass }}">
                                            {{ $order->status }}
                                        </span>

                                        {{-- Tombol Bayar Sekarang (Conditional) --}}
                                        @if ($order->payment_status == 'pending')
                                            {{-- INI BAGIAN PENTING: Arahkan ke rute payment yang sudah ada --}}
                                            <a href="{{ route('customer.order.payment', $order) }}"
                                                class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                    </path>
                                                </svg>
                                                Bayar Sekarang
                                            </a>
                                        @endif

                                        <!-- Tombol Lacak Gerobak (Conditional) -->
                                        @if ($order->payment_status == 'paid' && in_array(strtolower($order->status), ['diproses', 'in progress', 'ready for pickup']))
                                            <button type="button" class="track-button ..." {{-- ... (data attributes) ... --}}>
                                                Lacak Gerobak
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center bg-white p-8 rounded-lg shadow-md border-2 border-dashed">
                                {{-- Ikon SVG untuk menandakan 'kosong' --}}
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8.25 6.75h7.5M8.25 12h7.5m-7.5 5.25h7.5m3-15H5.25A2.25 2.25 0 003 5.25v13.5A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V5.25A2.25 2.25 0 0018.75 3z" />
                                </svg>

                                <h3 class="mt-4 text-xl font-semibold text-gray-800">Belum Ada Pesanan Aktif</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Anda saat ini tidak memiliki pesanan yang sedang diproses. Saatnya membuat sepatumu bersih
                                    kembali!
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </main>
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
        // Kode JavaScript Anda tetap sama seperti sebelumnya, tidak perlu diubah.
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
            let map = null;
            let marker = null;

            const openModal = (lat, lng, workerName) => {
                if (!lat || !lng || lat === '' || lng === '') {
                    alert('Lokasi untuk gerobak ini tidak tersedia.');
                    return;
                }

                modalTitle.textContent = `Lokasi ${workerName}`;
                mapModal.classList.remove('hidden');

                if (!map) {
                    map = L.map('track-map').setView([lat, lng], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);
                } else {
                    map.setView([lat, lng], 15);
                }

                if (!marker) {
                    marker = L.marker([lat, lng]).addTo(map);
                } else {
                    marker.setLatLng([lat, lng]);
                }
                marker.bindPopup(`<b>${workerName}</b>`).openPopup();

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
            mapModal.addEventListener('click', (event) => {
                if (event.target === mapModal) {
                    closeModal();
                }
            });
        });
    </script>
@endpush