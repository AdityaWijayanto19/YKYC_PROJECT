@extends('layouts.worker')

@section('title', 'Tugas Aktif')

@php
    function getStatusClass($statusName) 
    {
        return match ($statusName) { 
            'waiting_mangkal', 'waiting_keliling', 'pending' => 'bg-yellow-100 text-yellow-800',
            'on-the-way' => 'bg-indigo-100 text-indigo-800', 
            'diproses' => 'bg-blue-100 text-blue-800',
            'ready for pick up' => 'bg-purple-100 text-purple-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled', 'dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
@endphp

@section('content')
    <div class="container mx-auto max-w-5xl px-4 py-8">
        <header class="mb-6">
            <div class="flex justify-between items-center flex-wrap gap-3">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tugas Aktif Saya</h1>
                    <p class="text-gray-600">
                        Menampilkan tugas untuk Worker
                        <span
                            class="font-medium {{ $worker->worker_type === 'Keliling' ? 'text-blue-600' : 'text-green-600' }}">
                            {{ $worker->worker_type }}
                        </span>
                    </p>
                </div>
            </div>
        </header>

        @if ($worker->worker_type === 'Keliling')

            @if ($active_orders->isNotEmpty())
                @php $order = $active_orders->first(); @endphp
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <div class="bg-white rounded-2xl shadow-md p-5 sticky top-4">
                            <h2 class="text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                <i data-lucide="map" class="w-5 h-5 text-green-600"></i>
                                Rute Penjemputan
                            </h2>
                            <div id="map" class="h-80 rounded-lg bg-gray-200 flex items-center justify-center">
                                <p class="text-gray-500">Memuat peta rute...</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <div class="p-5 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-xl text-gray-800">Misi: #{{ $order->order_id }}</h3>
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ getStatusClass($order->status->name) }}">
                                    {{ $order->status->label }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">Status saat ini: <span class="font-medium text-gray-700">{{ $order->status->label }}</span></p>
                        </div>
                        <div class="p-5 space-y-4">
                            <div><p class="text-sm text-gray-500">Pelanggan:</p><p class="font-semibold text-lg text-gray-800">{{ $order->user->name }}</p></div>
                            <div><p class="text-sm text-gray-500">Layanan:</p><p class="font-medium text-gray-900">{{ $order->service->name }}</p></div>
                            <div><p class="text-sm text-gray-500">Alamat Penjemputan:</p><p class="text-gray-700">{{ $order->customer_address ?? 'Tidak ada alamat' }}</p></div>
                        </div>
                        <div class="p-4 bg-gray-50 border-t grid grid-cols-2 gap-3">
                            <a href="https://www.google.com/maps/dir/?api=1&destination={{ $order->customer_lat }},{{ $order->customer_lng }}" target="_blank" class="flex items-center justify-center gap-2 w-full text-center bg-gray-800 text-white font-semibold py-3 rounded-lg hover:bg-gray-900 transition"><i data-lucide="navigation" class="w-5 h-5"></i> Buka Gmaps</a>
                            <a href="tel:{{ $order->user->number_phone }}" class="flex items-center justify-center gap-2 w-full text-center bg-gray-200 text-gray-800 font-semibold py-3 rounded-lg hover:bg-gray-300 transition"><i data-lucide="phone" class="w-5 h-5"></i> Telepon</a>
                        </div>
                        <div class="p-4 bg-gray-50">
                            @if($order->status->name === 'waiting_keliling')
                                <form action="{{ route('worker.order.updateStatus', $order) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="on-the-way">
                                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-lg transition text-lg">
                                        Berangkat Menuju Lokasi
                                    </button>
                                </form>
                            @elseif($order->status->name === 'on-the-way')
                                <form action="{{ route('worker.order.updateStatus', $order) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="diproses">
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-lg transition text-lg">
                                        Konfirmasi Pengambilan Sepatu
                                    </button>
                                </form>
                            @elseif($order->status->name === 'diproses')
                                <form action="{{ route('worker.order.updateStatus', $order) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-lg transition text-lg">
                                        Tandai Pesanan Selesai
                                    </button>
                                </form>
                            @else
                                <div class="text-center text-gray-500 py-4">
                                    Status: {{ $order->status->label }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center bg-white p-10 rounded-2xl shadow-md border"><i data-lucide="coffee" class="w-16 h-16 mx-auto text-green-500"></i><h3 class="mt-4 text-xl font-bold text-gray-800">Anda Siap Menerima Tugas!</h3><p class="mt-1 text-gray-500">Pastikan status Anda <a href="{{ route('worker.dashboard') }}" class="font-semibold text-green-600 hover:underline">'Online'</a> di halaman Dashboard untuk mulai menerima pesanan.</p></div>
            @endif

        @else

            <div class="space-y-5">
                @forelse ($active_orders as $order)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="p-4 border-b border-gray-200 flex justify-between items-center flex-wrap gap-2">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">Pesanan #{{ $order->order_id }}</h3>
                                <p class="text-sm text-gray-500">Oleh: {{ $order->user->name }}</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full capitalize {{ getStatusClass($order->status->name) }}">
                                {{ $order->status->label ?? $order->status->name }}
                            </span>
                        </div>

                        <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Layanan</p>
                                <p class="font-semibold text-gray-900">{{ $order->service->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Metode</p>
                                <p class="font-medium text-gray-800">
                                    {{ $order->delivery_method === 'pickup' ? 'Dijemput Worker' : 'Antar Sendiri' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Tanggal Pesan</p>
                                <p class="text-gray-700">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="p-4 bg-gray-50 border-t flex items-center justify-end">
                            <form action="{{ route('worker.order.updateStatus', $order) }}" method="POST">
                                @csrf
                                @if($order->status->name === 'waiting_mangkal')
                                    <input type="hidden" name="status" value="diproses">
                                    <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                                        Mulai Kerjakan
                                    </button>
                                @elseif($order->status->name === 'diproses')
                                    <input type="hidden" name="status" value="ready for pick up">
                                    <button type="submit"
                                        class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                                        Tandai Siap Diambil
                                    </button>
                                @elseif($order->status->name === 'ready for pick up')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                                        Konfirmasi Selesai
                                    </button>
                                @else
                                    <span class="text-gray-500 text-sm">Status: {{ $order->status->label }}</span>
                                @endif
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center bg-white p-10 rounded-2xl shadow-md border">
                        <i data-lucide="package-check" class="w-16 h-16 mx-auto text-gray-400"></i>
                        <h3 class="mt-4 text-xl font-bold text-gray-800">Semua Tugas Selesai!</h3>
                        <p class="mt-1 text-gray-500">Tidak ada pesanan aktif di antrian Anda saat ini. Kerja bagus!</p>
                    </div>
                @endforelse
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    <script>
        lucide.createIcons();
        const workerType = '{{ $worker->worker_type }}';
        if (workerType === 'Keliling' && document.getElementById('map')) {
            @if ($active_orders->isNotEmpty())
                const order = @json($active_orders->first());
                const customerLat = parseFloat(order.customer_lat);
                const customerLng = parseFloat(order.customer_lng);
                const customerName = order.user.name;
                const mapElement = document.getElementById('map');
                mapElement.innerHTML = '';
                const map = L.map('map');
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                navigator.geolocation.getCurrentPosition(function (position) {
                    const workerLat = position.coords.latitude;
                    const workerLng = position.coords.longitude;
                    L.Routing.control({
                        waypoints: [L.latLng(workerLat, workerLng), L.latLng(customerLat, customerLng)],
                        routeWhileDragging: false, show: false, fitSelectedRoutes: true,
                        lineOptions: { styles: [{ color: '#1D4ED8', opacity: 0.9, weight: 7 }] },
                        createMarker: function (i, waypoint, n) {
                            let popupText = ""; let iconUrl = "";
                            if (i === 0) { popupText = "<b>Posisi Anda Saat Ini</b>"; iconUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png'; }
                            else if (i === n - 1) { popupText = `<b>Jemput di Sini</b><br>${customerName}`; iconUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png'; }
                            return L.marker(waypoint.latLng, { icon: L.icon({ iconUrl: iconUrl, iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png', shadowSize: [41, 41] }) }).bindPopup(popupText);
                        }
                    }).addTo(map);
                }, function (error) {
                    console.error("Gagal mendapatkan lokasi worker:", error);
                    mapElement.innerHTML = '<p class="text-center text-red-600 font-medium">Gagal mendapatkan lokasi Anda. Pastikan izin lokasi/GPS sudah aktif.</p>';
                });
            @endif
        }
    </script>
@endpush