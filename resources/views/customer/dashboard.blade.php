@extends('layouts.customer')

@section('title', 'Dashboard Customer')

@push('styles')
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .map-viewport {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        #map {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
        }

        #panel-content {
            transition: all 0.3s ease-in-out;
        }

        #panel-content.is-hidden {
            width: 0 !important;
            max-width: 0 !important;
            opacity: 0;
            overflow: hidden;
            margin-left: -0.5rem;
        }

        .collapse-icon {
            transition: transform 0.2s ease;
        }

        .is-collapsed .collapse-icon {
            transform: rotate(-90deg);
        }

        .promo-carousel .swiper-slide img {
            border-radius: 0.75rem;
        }
    </style>
@endpush

@section('content')
    <main class="relative w-screen h-screen overflow-hidden map-viewport">

        <div id="map" class="absolute inset-0 z-0 w-full h-full"></div>
        <div id="map-hint"
            class="absolute inset-0 z-[9999] flex items-center justify-center bg-black/60 text-white text-2xl font-bold opacity-0 pointer-events-none transition-opacity duration-300">
            <p class="text-center">Gunakan CTRL + scroll untuk<br>memperbesar atau memperkecil peta</p>
        </div>

        <div id="panel-container" class="absolute top-3 right-3 bottom-3 z-10 flex flex-row-reverse items-start gap-2">

            <div id="panel-content" class="w-64 md:w-80 h-full flex flex-col">
                <div class="flex-1 overflow-y-auto space-y-3 pr-1">
                    <div class="bg-white rounded-xl shadow-lg">
                        <div class="p-3">
                            <div class="swiper promo-carousel rounded-lg shadow-inner overflow-hidden">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img
                                            src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=600&auto=format&fit=crop"
                                            alt="Promo 1" class="w-full h-36 object-cover"></div>
                                    <div class="swiper-slide"><img
                                            src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=600&auto=format=crop"
                                            alt="Promo 2" class="w-full h-36 object-cover"></div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg">
                        <div data-toggle="collapse" data-target="#card-tracking-content"
                            class="p-3 cursor-pointer flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-700">Lacak Pesanan Saya</h3>
                            <svg class="w-5 h-5 text-gray-500 collapse-icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div id="card-tracking-content" class="px-3 pb-3">
                            <div class="grid grid-cols-3 gap-2">
                                <a href="{{ route('customer.order.status') }}"
                                    class="p-2 text-center bg-gray-50 border rounded-lg hover:shadow-sm transition">
                                    <p class="text-xl font-bold text-yellow-600">{{ $countPending }}</p>
                                    <p class="text-xs text-gray-500">Menunggu</p>
                                </a>
                                <a href="{{ route('customer.order.status') }}"
                                    class="p-2 text-center bg-gray-50 border rounded-lg hover:shadow-sm transition">
                                    <p class="text-xl font-bold text-blue-600">{{ $countInProgress }}</p>
                                    <p class="text-xs text-gray-500">Diproses</p>
                                </a>
                                <a href="{{ route('customer.order.status') }}"
                                    class="p-2 text-center bg-gray-50 border rounded-lg hover:shadow-sm transition">
                                    <p class="text-xl font-bold text-green-600">{{ $countReady }}</p>
                                    <p class="text-xs text-gray-500">Siap Ambil</p>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg">
                        <div data-toggle="collapse" data-target="#card-history-content"
                            class="p-3 cursor-pointer flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-700">Riwayat Terbaru</h3>
                            <svg class="w-5 h-5 text-gray-500 collapse-icon" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <div id="card-history-content" class="px-3 pb-3">
                            <div class="space-y-2">
                                @forelse ($recentOrders as $order)
                                    <div class="flex justify-between items-center">
                                        <p class="font-semibold text-gray-800 text-sm">
                                            {{ $order->service->name ?? 'Layanan Tidak Diketahui' }} - #{{ $order->order_id }}
                                        </p>
                                       <span class="px-2 py-0.5 text-xs font-semibold 
                                            @php $statusName = strtolower($order->status->name ?? 'unknown'); @endphp
                                            @if($statusName == 'completed' || $statusName == 'selesai') 
                                                text-green-800 bg-green-100 
                                            @elseif($statusName == 'pending') 
                                                text-yellow-800 bg-yellow-100 
                                            @elseif($statusName == 'ready for pickup') 
                                                text-purple-800 bg-purple-100
                                            @elseif($statusName == 'diproses' || $statusName == 'in progress') 
                                                text-blue-800 bg-blue-100 
                                            @else 
                                                text-gray-800 bg-gray-100 
                                            @endif
                                            rounded-full">  
                                            {{ ucfirst($order->status->name ?? 'Tidak diketahui') }}
                                        </span>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 italic">Belum ada riwayat pesanan.</p>
                                @endforelse
                            </div>

                            <div class="pt-2 mt-2 text-center border-t border-gray-100"><a
                                    href="{{ route('customer.history') }}"
                                    class="text-xs font-semibold text-primary hover:underline">Lihat Semua Riwayat</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-shrink-0 pt-2">
                <button id="hide-panel-btn"
                    class="w-10 h-10 bg-white rounded-lg shadow-lg flex items-center justify-center focus:outline-none">
                    <svg id="hide-panel-icon" class="w-5 h-5 text-gray-600 transition-transform duration-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const hideBtn = document.getElementById('hide-panel-btn');
            const panelContent = document.getElementById('panel-content');
            const hideIcon = document.getElementById('hide-panel-icon');
            if (hideBtn) {
                hideBtn.addEventListener('click', () => {
                    panelContent.classList.toggle('is-hidden');
                    hideIcon.style.transform = panelContent.classList.contains('is-hidden')
                        ? 'rotate(180deg)' : 'rotate(0deg)';
                });
            }

            document.querySelectorAll('[data-toggle="collapse"]').forEach(header => {
                header.addEventListener('click', () => {
                    const targetContent = document.querySelector(header.dataset.target);
                    targetContent.classList.toggle('hidden');
                    header.classList.toggle('is-collapsed');
                });
            });

            new Swiper('.promo-carousel', {
                loop: true,
                autoplay: { delay: 4000, disableOnInteraction: false },
                pagination: { el: '.swiper-pagination', clickable: true },
            });

            const mapElement = document.getElementById('map');
            if (mapElement) {
                const map = L.map('map', { zoomControl: false, scrollWheelZoom: false, attributionControl: false }).setView([-7.9667, 112.6324], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '©YKYC' }).addTo(map);

                const serviceAreaPolygon = @json($serviceAreaPolygon ?? []);
                if (serviceAreaPolygon.length > 0) {
                    L.polygon(serviceAreaPolygon, {
                        color: '#5483B3', weight: 2, dashArray: '5, 5', fillOpacity: 0.1, fillColor: '#5483B3'
                    }).addTo(map);
                }

                const cartIcon = L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/3721/3721838.png',
                    iconSize: [40, 40], iconAnchor: [20, 40], popupAnchor: [0, -40]
                });
                const activeWorkers = @json($activeWorkers);
                activeWorkers.forEach(worker => {
                    if (worker.current_latitude && worker.current_longitude) {
                        const lat = parseFloat(worker.current_latitude);
                        const lng = parseFloat(worker.current_longitude);
                        if (worker.user && worker.user.name) {
                            L.marker([lat, lng], { icon: cartIcon }).addTo(map).bindPopup(`<b>${worker.user.name}</b>`);
                        }
                    }
                });

                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const customerIcon = L.icon({
                        iconUrl: 'https://cdn-icons-png.flaticon.com/128/727/727636.png',
                        iconSize: [35, 35], iconAnchor: [17, 35], popupAnchor: [0, -35]
                    });
                    L.marker([lat, lng], { icon: customerIcon }).addTo(map).bindPopup('<b>Posisi Anda</b>');
                    map.setView([lat, lng], 14);
                });

                const hint = document.getElementById('map-hint');
                let hideHintTimeout;

                map.getContainer().addEventListener('wheel', (e) => {
                    e.preventDefault();
                    if (e.ctrlKey) {
                        hint.classList.remove('opacity-100');
                        hint.classList.add('opacity-0');
                        clearTimeout(hideHintTimeout);
                        if (e.deltaY < 0) {
                            map.zoomIn();
                        } else {
                            map.zoomOut();
                        }
                    } else {
                        hint.classList.remove('opacity-0');
                        hint.classList.add('opacity-100');
                        clearTimeout(hideHintTimeout);
                        hideHintTimeout = setTimeout(() => {
                            hint.classList.remove('opacity-100');
                            hint.classList.add('opacity-0');
                        }, 1500);
                    }
                }, { passive: false });
            }
        });
    </script>
@endpush