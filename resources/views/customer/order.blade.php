@extends('layouts.customer')
@section('title', 'Buat Pesanan Baru - Ya Kotor Ya Cuci')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
    <div class="flex h-screen bg-gray-100">
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-4 bg-white border-b md:hidden">
                <h1 class="text-xl font-bold text-primary">Buat Pesanan</h1>
                <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                        </path>
                    </svg>
                </button>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 pb-36">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Pesanan Baru</h2>
                    <p class="text-gray-500 mb-8">Lengkapi detail di bawah ini untuk membersihkan sepatumu.</p>

                    <div class="max-w-2xl mx-auto">
                        <div class="bg-white p-8 rounded-xl shadow-lg w-full">
                            <form method="POST" action="{{ route('customer.order.store') }}" class="space-y-6">
                                @csrf

                                <div>
                                    <label for="service_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Jenis Layanan</label>
                                    <select id="service_id" name="service_id" required class="block w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="" data-price="0" disabled selected>-- Pilih salah satu --</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pengambilan</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="delivery-option-card" data-value="drop-off">
                                            <input type="radio" id="drop-off" name="delivery_method" value="drop-off" class="hidden" checked>
                                            <label for="drop-off" class="block p-4 border rounded-lg cursor-pointer">
                                                <h4 class="font-semibold text-gray-800">Datang ke Gerobak</h4>
                                                <p class="text-sm text-gray-500">Antar sepatumu langsung ke lokasi gerobak kami.</p>
                                            </label>
                                        </div>
                                        <div class="delivery-option-card" data-value="pickup">
                                            <input type="radio" id="pickup" name="delivery_method" value="pickup" class="hidden">
                                            <label for="pickup" class="block p-4 border rounded-lg cursor-pointer">
                                                <h4 class="font-semibold text-gray-800">Datang ke lokasi anda</h4>
                                                <p class="text-sm text-gray-500">Kami akan menjemput dan mengantar sepatumu.</p>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div id="location-section">
                                    <label for="worker_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Lokasi Gerobak (Worker)</label>
                                    <select id="worker_id" name="worker_id" class="block w-full px-4 py-3 rounded-lg border border-gray-300">
                                        <option value="" disabled selected>-- Pilih lokasi terdekat --</option>
                                        @foreach ($workers as $worker)
                                            <option value="{{ $worker->id }}">{{ $worker->location_name ?? $worker->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="address-section" class="hidden">
                                    <label for="map-order" class="block text-sm font-semibold text-gray-700 mb-2">Tentukan Lokasi Penjemputan Anda</label>
                                    
                                    <div class="relative">
                                        <div id="map-order" style="height: 400px; width: 100%; border-radius: 0.75rem; z-index: 0;"></div>
                                        <div id="map-hint" class="absolute inset-0 z-[1000] flex items-center justify-center bg-black/60 text-white text-xl font-bold opacity-0 pointer-events-none transition-opacity duration-300">
                                            <p class="text-center">Gunakan CTRL + scroll untuk<br>memperbesar atau memperkecil peta</p>
                                        </div>
                                    </div>
                                    
                                    <div id="map-warning" class="hidden mt-2 p-3 text-sm text-red-700 bg-red-100 rounded-lg"></div>

                                    <input type="hidden" name="customer_lat" id="pickup_latitude">
                                    <input type="hidden" name="customer_lng" id="pickup_longitude">
                                    @error('alamat')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                                    @error('customer_lat')<p class="text-red-500 text-xs mt-2">Silakan tentukan lokasi di peta.</p>@enderror
                                </div>

                                <div class="border-t pt-6 mt-6 space-y-2 bg-gray-50 rounded-lg p-4">
                                    <h3 class="text-lg font-semibold text-gray-800">Ringkasan Pesanan</h3>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Layanan:</span>
                                        <span id="summary-service" class="font-semibold text-gray-800">-</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Biaya Jemput-Antar:</span>
                                        <span id="summary-delivery-fee" class="font-semibold text-gray-800">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between text-lg">
                                        <span class="text-gray-700">Total Estimasi:</span>
                                        <span id="summary-total" class="font-bold text-primary">Rp 0</span>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" id="submit-button" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-secondary">
                                        Konfirmasi & Lanjutkan Pembayaran
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const serviceSelect = document.getElementById('service_id');
            const deliveryOptionCards = document.querySelectorAll('.delivery-option-card');
            const deliveryRadioButtons = document.querySelectorAll('input[name="delivery_method"]');
            const locationSection = document.getElementById('location-section');
            const addressSection = document.getElementById('address-section');
            const summaryService = document.getElementById('summary-service');
            const summaryDeliveryFee = document.getElementById('summary-delivery-fee');
            const summaryTotal = document.getElementById('summary-total');
            const submitButton = document.getElementById('submit-button');
            const mapWarning = document.getElementById('map-warning');

            function formatRupiah(number) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number); }
            function updateSummary() {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const serviceName = selectedOption.textContent.trim();
                const servicePrice = parseInt(selectedOption.dataset.price) || 0;
                const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked').value;
                const deliveryFee = (selectedDelivery === 'pickup' && !pickupRadio.disabled) ? 15000 : 0;
                const totalPrice = servicePrice + deliveryFee;
                summaryService.textContent = serviceName || '-';
                summaryDeliveryFee.textContent = formatRupiah(deliveryFee);
                summaryTotal.textContent = formatRupiah(totalPrice);
            }

            const pickupCard = document.querySelector('.delivery-option-card[data-value="pickup"]');
            const pickupRadio = document.getElementById('pickup');
            const pickupLabel = pickupCard.querySelector('label');
            const pickupInfoText = pickupCard.querySelector('p');
            const serviceAreaPolygon = @json($serviceAreaPolygon ?? []);
            let map = null, pickupMarker = null;

            function validateMarkerPosition(lat, lng) {
                const point = [lat, lng];
                if (isPointInPolygon(point, serviceAreaPolygon)) {
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    mapWarning.classList.add('hidden');
                } else {
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                    mapWarning.textContent = 'Lokasi yang Anda pilih berada di luar jangkauan layanan.';
                    mapWarning.classList.remove('hidden');
                }
            }

            function isPointInPolygon(point, polygon) {
                let isInside = false;
                const lat = point[0], lng = point[1];
                for (let i = 0, j = polygon.length - 1; i < polygon.length; j = i++) {
                    const xi = polygon[i][0], yi = polygon[i][1];
                    const xj = polygon[j][0], yj = polygon[j][1];
                    const intersect = ((yi > lng) !== (yj > lng)) && (lat < (xj - xi) * (lng - yi) / (yj - yi) + xi);
                    if (intersect) isInside = !isInside;
                }
                return isInside;
            }

            function initializeMap(customerLat, customerLng) {
                if (!map) {
                    map = L.map('map-order', { scrollWheelZoom: false, zoomControl: false, attributionControl: false }).setView([customerLat, customerLng], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                    L.polygon(serviceAreaPolygon, { color: '#5483B3', weight: 2, dashArray: '5, 5', fillOpacity: 0.1 }).addTo(map);
                    const latInput = document.getElementById('pickup_latitude');
                    const lngInput = document.getElementById('pickup_longitude');
                    latInput.value = customerLat;
                    lngInput.value = customerLng;
                    pickupMarker = L.marker([customerLat, customerLng], { draggable: true }).addTo(map);

                    map.on('click', function (e) {
                        latInput.value = e.latlng.lat;
                        lngInput.value = e.latlng.lng;
                        pickupMarker.setLatLng(e.latlng);
                        validateMarkerPosition(e.latlng.lat, e.latlng.lng);
                    });
                    pickupMarker.on('dragend', function (e) {
                        const pos = e.target.getLatLng();
                        latInput.value = pos.lat;
                        lngInput.value = pos.lng;
                        validateMarkerPosition(pos.lat, pos.lng);
                    });

                    validateMarkerPosition(customerLat, customerLng);

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
            }

            function checkCustomerLocation() {
                const customerLocation = @json($customerLocation ?? null);
                if (serviceAreaPolygon.length === 0) {
                    pickupRadio.disabled = true;
                    pickupLabel.classList.add('bg-gray-200', 'cursor-not-allowed', 'opacity-50');
                    pickupInfoText.textContent = "Layanan jemput-antar belum tersedia.";
                    return;
                };

                if (customerLocation && customerLocation.lat && customerLocation.lng) {
                    const customerPoint = [customerLocation.lat, customerLocation.lng];
                    if (isPointInPolygon(customerPoint, serviceAreaPolygon)) {
                        pickupRadio.disabled = false;
                        pickupLabel.classList.remove('bg-gray-200', 'cursor-not-allowed', 'opacity-50');
                        pickupInfoText.textContent = "Lokasi Anda terjangkau. Silakan pilih titik jemput.";
                        initializeMap(customerPoint[0], customerPoint[1]);
                    } else {
                        pickupRadio.disabled = true;
                        pickupLabel.classList.add('bg-gray-200', 'cursor-not-allowed', 'opacity-50');
                        pickupInfoText.textContent = "Maaf, alamat di profil Anda berada di luar jangkauan.";
                    }
                } else {
                    pickupRadio.disabled = true;
                    pickupLabel.classList.add('bg-gray-200', 'cursor-not-allowed', 'opacity-50');
                    pickupInfoText.textContent = "Lengkapi lokasi di profil Anda untuk memesan.";
                }
            }

            function handleDeliveryChange() {
                const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked').value;
                deliveryOptionCards.forEach(card => {
                    if (card.dataset.value === selectedDelivery) { card.querySelector('label').classList.add('border-primary', 'ring-2', 'ring-primary'); }
                    else { card.querySelector('label').classList.remove('border-primary', 'ring-2', 'ring-primary'); }
                });
                if (selectedDelivery === 'drop-off') {
                    locationSection.style.display = 'block';
                    addressSection.style.display = 'none';
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    mapWarning.classList.add('hidden');
                } else {
                    locationSection.style.display = 'none';
                    addressSection.style.display = 'block';
                    if (pickupMarker) {
                        const pos = pickupMarker.getLatLng();
                        validateMarkerPosition(pos.lat, pos.lng);
                    }
                    setTimeout(() => { if (map) map.invalidateSize() }, 100);
                }
                updateSummary();
            }

            serviceSelect.addEventListener('change', updateSummary);
            deliveryRadioButtons.forEach(radio => radio.addEventListener('change', handleDeliveryChange));
            deliveryOptionCards.forEach(card => {
                card.addEventListener('click', () => {
                    if (!card.querySelector('input').disabled) {
                        card.querySelector('input').checked = true;
                        const changeEvent = new Event('change', { bubbles: true });
                        card.querySelector('input').dispatchEvent(changeEvent);
                    }
                });
            });
            handleDeliveryChange();
            updateSummary();
            checkCustomerLocation();
        });
    </script>
@endpush