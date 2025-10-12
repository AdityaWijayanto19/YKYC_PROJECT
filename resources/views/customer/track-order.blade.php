@extends('layouts.customer')

@section('title', 'Lacak Pesanan #' . $order->order_id)

@push('styles')
    {{-- Pastikan Anda sudah punya aset Leaflet di layout utama, jika belum, tambahkan ini --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="container mx-auto max-w-4xl">
            <div class="bg-white p-6 rounded-2xl shadow-xl">

                <!-- Header Informasi Pesanan -->
                <div class="border-b border-gray-200 pb-4 mb-5">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Driver sedang dalam perjalanan!</h1>
                    <p class="text-gray-500 mt-1">Lacak posisi driver untuk pesanan <span
                            class="font-semibold text-gray-700">#{{ $order->order_id }}</span></p>

                    <div class="mt-3 flex items-center gap-4">
                        <p class="text-gray-600">Status:</p>
                        <span id="order-status-badge"
                            class="font-bold capitalize px-3 py-1 rounded-full text-sm 
                                {{ $order->status->name === 'waiting' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ $order->status->label }}
                        </span>
                    </div>
                </div>

                <!-- Peta Pelacakan -->
                <div id="tracking-map" class="h-96 w-full bg-gray-200 rounded-lg z-0">
                    <p class="text-center pt-10 text-gray-500">Memuat peta pelacakan...</p>
                </div>

                <!-- Informasi Driver -->
                <div class="mt-5 p-4 bg-gray-50 rounded-lg border">
                    <h2 class="font-bold text-lg text-gray-800">Informasi Driver</h2>
                    @if($order->worker && $order->worker->user)
                        <p class="text-gray-600">Nama: <span
                                class="font-medium text-gray-900">{{ $order->worker->user->name }}</span></p>
                    @else
                        <p class="text-gray-600">Driver sedang ditugaskan...</p>
                    @endif
                </div>

            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data penting dari PHP
        const customerLat = {{ $order->customer_lat }};
        const customerLng = {{ $order->customer_lng }};
        const orderUserId = {{ $order->user_id }};
        
        @if($order->worker && $order->worker->current_latitude)
            const initialWorkerLat = {{ $order->worker->current_latitude }};
            const initialWorkerLng = {{ $order->worker->current_longitude }};
        @else
            const initialWorkerLat = null;
            const initialWorkerLng = null;
        @endif

        const mapElement = document.getElementById('tracking-map');
        mapElement.innerHTML = '';
        const map = L.map('tracking-map');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let routingControl = null;

        // ▼▼▼ KEMBALIKAN ISI FUNGSI INI ▼▼▼
        function updateRoute(workerLatLng) {
            const customerLatLng = L.latLng(customerLat, customerLng);

            if (routingControl) {
                // Jika rute sudah ada, cukup update titik awalnya
                routingControl.setWaypoints([
                    workerLatLng,
                    customerLatLng
                ]);
            } else {
                // Jika rute belum ada, buat yang baru
                routingControl = L.Routing.control({
                    waypoints: [
                        workerLatLng,
                        customerLatLng
                    ],
                    routeWhileDragging: false,
                    show: false,
                    fitSelectedRoutes: true,
                    lineOptions: {
                        styles: [{ color: '#1D4ED8', opacity: 0.8, weight: 6 }]
                    },
                    createMarker: function(i, waypoint, n) {
                        let popupText = (i === 0) ? "<b>Worker YKYC</b>" : "<b>Lokasi Anda</b>";
                        let iconUrl = (i === 0) 
                            ? 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png'
                            : 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png';
                        
                        return L.marker(waypoint.latLng, {
                            icon: L.icon({
                                iconUrl: iconUrl,
                                iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34],
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png', shadowSize: [41, 41]
                            })
                        }).bindPopup(popupText);
                    }
                }).addTo(map);
            }
        }
        // ▲▲▲ AKHIR DARI ISI FUNGSI ▲▲▲

        if (initialWorkerLat && initialWorkerLng) {
            console.log("Menggambar rute awal berdasarkan data dari server.");
            const initialWorkerLatLng = L.latLng(initialWorkerLat, initialWorkerLng);
            updateRoute(initialWorkerLatLng);
        } else {
            console.log("Lokasi awal worker tidak ditemukan. Menampilkan lokasi customer.");
            L.marker([customerLat, customerLng]).addTo(map).bindPopup("<b>Lokasi Anda</b>");
            map.setView([customerLat, customerLng], 15);
        }

        // Mulai mendengarkan event real-time (kode ini sudah benar)
        if (window.Echo) {
            // ... (sisa kode Echo Anda sudah benar)
        } else {
            console.error("Laravel Echo tidak terkonfigurasi.");
        }
    });
    </script>
@endpush