@extends('layouts.worker')

@section('title', 'Dashboard Worker')

@section('content')
<div class="min-h-screen bg-gray-50 px-4 py-8">
    <header class="mb-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                     Selamat Datang, {{ $worker->user->name }}
                </h1>
                <p class="text-gray-600 text-sm mt-1">
                    Anda login sebagai Worker 
                    <span class="font-medium {{ $worker->worker_type === 'Keliling' ? 'text-blue-600' : 'text-green-600' }}">
                        {{ $worker->worker_type }}
                    </span>
                </p>
            </div>

            <div class="flex items-center mt-4 md:mt-0">
                <span id="status-text" class="mr-3 font-semibold {{ $worker->is_active ? 'text-green-600' : 'text-gray-500' }}">
                    {{ $worker->is_active ? ($worker->worker_type === 'Keliling' ? 'Online' : 'Online') : ($worker->worker_type === 'Keliling' ? 'Offline' : 'Offline') }}
                </span>
                <label for="active-toggle" class="inline-flex relative items-center cursor-pointer group">
                    <input type="checkbox" id="active-toggle" class="sr-only peer" {{ $worker->is_active ? 'checked' : '' }}>
                    <div
                        class="w-14 h-8 bg-gray-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:bg-green-500
                        after:content-[''] after:absolute after:top-1 after:left-[4px] after:bg-white after:h-6 after:w-6 after:rounded-full
                        after:transition-all peer-checked:after:translate-x-6 shadow-inner">
                    </div>
                </label>
            </div>
        </div>
    </header>

    @if ($worker->worker_type === 'Keliling')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100 h-full">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-5 h-5 text-blue-600"></i>
                        Peta & Lokasi Anda
                    </h2>
                    <div id="map" class="h-[450px] bg-gray-200 rounded-xl flex items-center justify-center">
                        <p class="text-gray-500 text-sm">Aktifkan status untuk memulai pelacakan di peta.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i data-lucide="zap" class="w-5 h-5 text-orange-500"></i>
                        Status & Aksi
                    </h2>
                    <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg text-center">
                        <p id="status-info-text" class="text-sm font-semibold text-blue-800">
                            {{ $worker->is_active ? 'Anda sedang aktif dan terlihat oleh customer.' : 'Anda sedang offline. Aktifkan untuk menerima pesanan.' }}
                        </p>
                    </div>
                    <a href="{{ route('worker.pesanan-actived.active') }}" class="mt-4 flex items-center justify-center gap-2 w-full text-center bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                        {{ $orders->count() > 0 ? 'Lihat Tugas Saat Ini' : 'Belum Ada Tugas' }}
                    </a>
                </div>
                 <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i data-lucide="history" class="w-5 h-5 text-indigo-500"></i>
                        Riwayat
                    </h2>
                     <a href="{{ route('worker.history-pesanan') }}" class="flex items-center justify-center gap-2 w-full text-center bg-gray-200 text-gray-800 font-semibold py-3 rounded-lg hover:bg-gray-300 transition">
                        <i data-lucide="clock" class="w-5 h-5"></i> Lihat Riwayat Pesanan
                    </a>
                </div>
            </div>
        </div>

    @else

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                     <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i data-lucide="store" class="w-5 h-5 text-green-600"></i>
                        Ringkasan Kegiatan Anda
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-center">
                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
                            <p class="text-4xl font-bold text-blue-600">{{ $orders->where('status.name', 'diproses')->count() }}</p>
                            <p class="text-sm text-gray-600 mt-1">Pesanan Sedang Dikerjakan</p>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                            <p class="text-4xl font-bold text-yellow-600">{{ $orders->where('status.name', 'ready for pick up')->count() }}</p>
                            <p class="text-sm text-gray-600 mt-1">Pesanan Siap Diambil</p>
                        </div>
                    </div>
                </div>

                 <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                            <i data-lucide="package" class="w-5 h-5 text-blue-600"></i>
                            Antrian Tugas
                        </h2>
                        <a href="{{ route('worker.pesanan-actived.active') }}" class="text-sm text-blue-600 hover:underline">
                            Lihat Semua
                        </a>
                    </div>
                     <div class="space-y-4">
                        @forelse ($orders->take(3) as $order) 
                            <div class="border rounded-xl p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $order->service->name }}</p>
                                        <p class="text-sm text-gray-500">ID: {{ $order->order_id }} oleh {{ $order->user->name }}</p>
                                    </div>
                                    <span class="text-xs font-semibold capitalize px-2 py-1 rounded-full {{ $order->status->name === 'ready for pick up' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $order->status->label ?? $order->status->name }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm text-center py-4">Tidak ada tugas aktif saat ini. Waktunya bersantai!</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i data-lucide="zap" class="w-5 h-5 text-orange-500"></i>
                        Aksi Cepat
                    </h2>
                    <div class="space-y-3">
                        <a href="{{ route('worker.pesanan-actived.active') }}" class="flex items-center justify-center gap-2 w-full text-center bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                            <i data-lucide="clipboard-list" class="w-5 h-5"></i> Kelola Semua Pesanan
                        </a>
                        <a href="{{ route('worker.history-pesanan') }}" class="flex items-center justify-center gap-2 w-full text-center bg-gray-200 text-gray-800 font-semibold py-3 rounded-lg hover:bg-gray-300 transition">
                            <i data-lucide="clock" class="w-5 h-5"></i> Riwayat Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
lucide.createIcons();
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('active-toggle');
    const statusText = document.getElementById('status-text');
    const workerId = {{ Auth::user()->worker->id }};
    const workerType = '{{ $worker->worker_type }}';

    toggle.addEventListener('change', function() {
        const isActive = this.checked;
        fetch('{{ route("worker.status.toggle") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ is_active: isActive })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const activeText = workerType === 'Keliling' ? 'Online' : 'Online';
                const inactiveText = workerType === 'Keliling' ? 'Offline' : 'Offline';
                statusText.textContent = data.is_active ? activeText : inactiveText;
                statusText.classList.toggle('text-green-600', data.is_active);
                statusText.classList.toggle('text-gray-500', !data.is_active);

                if (workerType === 'Keliling') {
                    const statusInfo = document.getElementById('status-info-text');
                    statusInfo.textContent = data.is_active ? 'Anda sedang aktif dan terlihat oleh customer.' : 'Anda sedang offline. Aktifkan untuk menerima pesanan.';
                    setupMap(data.is_active);
                }
            }
        });
    });

    if (workerType === 'Keliling') {
        const mapContainer = document.getElementById('map');
        let watchId = null;
        let map = null;
        let workerMarker = null;

        const setupMap = (isActive) => {
            if (isActive && !map) { 
                mapContainer.innerHTML = '';
                map = L.map('map').setView([-7.9539, 112.6173], 15); 

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                startTracking();
            } else if (!isActive && map) { 
                stopTracking();
                map.remove();
                map = null;
                workerMarker = null;
                mapContainer.innerHTML = '<p class="text-gray-500 text-sm"> Aktifkan status untuk memulai pelacakan di peta.</p>';
            }
        };

        const startTracking = () => {
            if (!navigator.geolocation) return;
            if (watchId) return;

            watchId = navigator.geolocation.watchPosition(
                (pos) => {
                    const { latitude, longitude } = pos.coords;
                    fetch('{{ route("worker.location.update") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ lat: latitude, lng: longitude })
                    });

                    const newLatLng = [latitude, longitude];
                    if (!workerMarker) {
                        workerMarker = L.marker(newLatLng).addTo(map).bindPopup('Posisi Anda');
                        map.setView(newLatLng, 16); 
                    } else {
                        workerMarker.setLatLng(newLatLng);
                    }
                },
                (err) => console.error(err),
                { enableHighAccuracy: true }
            );
        };

        const stopTracking = () => {
            if (watchId) {
                navigator.geolocation.clearWatch(watchId);
                watchId = null;
            }
        };

        if (toggle.checked) {
            setupMap(true);
        }
    }

    if (workerType === 'Keliling' && window.Echo) {
        window.Echo.private(`worker.${workerId}`)
            .listen('.new-order-assigned', (e) => {
                
                const notification = document.createElement('div');
                notification.style.cssText = 'position: fixed; top: 20px; right: 20px; background-color: #2563EB; color: white; padding: 15px 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); font-size: 16px; z-index: 9999;';
                notification.innerHTML = `<strong>Tugas Baru Masuk!</strong><p>Anda mendapatkan pesanan penjemputan baru. Mengarahkan...</p>`;
                document.body.appendChild(notification);

                setTimeout(() => {
                    window.location.href = "{{ route('worker.pesanan-actived.active') }}";
                }, 2500);
            });
    }
});
</script>
@endpush