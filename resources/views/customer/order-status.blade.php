@extends('layouts.customer')

@section('title', 'Status Pesanan - Ya Kotor Ya Cuci')

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 pb-36">
    <div class="container mx-auto">
        @if (session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                <p>{{ session('info') }}</p>
            </div>
        @endif

        <h2 class="text-3xl font-bold text-gray-800 mb-2">Status Pesanan Aktif Anda</h2>
        <p class="text-gray-500 mb-8">Lacak progres pembersihan sepatumu di sini.</p>

        <div class="space-y-6">
            @forelse ($active_orders as $order)
                <div id="order-card-{{ $order->id }}" class="bg-white p-6 rounded-lg shadow-md transition hover:shadow-xl">
                    <div class="flex flex-wrap justify-between items-center gap-4">

                        <div class="flex-1 min-w-[250px]">
                            <div class="flex items-center gap-4">
                                <div>
                                    <p class="font-bold text-lg text-gray-800">{{ $order->service->name }}</p>
                                    <p class="text-sm text-gray-500">ID: {{ $order->order_id }} &bull; {{ $order->created_at->format('d M Y') }}</p>

                                    <div id="payment-status-{{ $order->id }}" class="mt-1">
                                        @if ($order->payment_status == 'paid')
                                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">Lunas</span>
                                        @else
                                            <span class="inline-block px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Pembayaran</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="action-buttons-{{ $order->id }}" class="flex-1 flex flex-col md:flex-row items-center justify-between gap-6">

                            <div class="w-full md:w-auto flex-1 px-4 md:px-0">
                                @php
                                    // Tentukan status sesuai delivery method
                                    if ($order->delivery_method == 'pickup') {
                                        $statuses = ['waiting_keliling', 'on-the-way', 'diproses', 'ready for pickup', 'completed'];
                                    } else { // drop-off / mangkal
                                        $statuses = ['waiting_mangkal', 'diproses', 'ready for pickup', 'completed'];
                                    }

                                    $currentStatus = $order->status->name;
                                    $currentStatusIndex = array_search($currentStatus, $statuses);
                                    if ($currentStatusIndex === false) $currentStatusIndex = 0;

                                    $statusLabels = [
                                        'pending' => 'Order Diterima',
                                        'waiting_keliling' => 'Menunggu Driver',
                                        'waiting_mangkal' => 'Menunggu',
                                        'on-the-way' => 'Penjemputan',
                                        'diproses' => 'Proses Cuci',
                                        'ready for pickup' => 'Siap Diambil',
                                        'completed' => 'Selesai',
                                    ];
                                @endphp

                                <div class="relative w-full">
                                    <div class="absolute top-4 left-0 w-full h-1 bg-gray-300"></div>
                                    <div class="absolute top-4 left-0 h-1 bg-primary" style="width: {{ ($currentStatusIndex / (count($statuses) - 1)) * 100 }}%;"></div>

                                    <div class="relative flex justify-between items-start">
                                        @foreach ($statuses as $index => $status)
                                            @php $isCompleted = ($index <= $currentStatusIndex); @endphp
                                            <div class="flex flex-col items-center text-center w-24">
                                                <div class="flex items-center justify-center w-8 h-8 rounded-full z-10 {{ $isCompleted ? 'bg-primary' : 'bg-gray-300' }} border-2 border-white">
                                                    @if ($isCompleted)
                                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    @else
                                                        <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                                                    @endif
                                                </div>
                                                <p class="text-xs capitalize mt-3 {{ $isCompleted ? 'font-semibold text-gray-800' : 'text-gray-400' }}">
                                                    {{ $statusLabels[$status] ?? $status }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                           <div class="flex flex-col sm:flex-row items-center gap-3 mt-6 md:mt-0">
    @if ($order->payment_status == 'pending')
        <a href="{{ route('customer.order.payment', $order) }}"
            class="w-full sm:w-auto text-white bg-blue-600 hover:bg-blue-700 font-semibold rounded-lg text-sm px-4 py-2 text-center flex items-center justify-center gap-2 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            Bayar Sekarang
        </a>
    @endif

    @if ($order->delivery_method == 'pickup' && $order->payment_status == 'paid' && in_array($order->status->name, ['on-the-way', 'diproses']))
        <a href="{{ route('customer.order.track', $order) }}"
            class="w-full sm:w-auto text-gray-900 bg-white hover:bg-gray-100 border border-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center flex items-center justify-center gap-2 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            Lacak Driver
        </a>
    @endif
</div>


                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center bg-white p-8 rounded-lg shadow-md border-2 border-dashed">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 6.75h7.5M8.25 12h7.5m-7.5 5.25h7.5m3-15H5.25A2.25 2.25 0 003 5.25v13.5A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V5.25A2.25 2.25 0 0018.75 3z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Belum Ada Pesanan Aktif</h3>
                    <p class="mt-2 text-base text-gray-500">Anda saat ini tidak memiliki pesanan yang sedang diproses. Saatnya membuat sepatumu bersih kembali!</p>
                </div>
            @endforelse
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');

            if (mobileMenuButton && sidebar) {
                mobileMenuButton.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }

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