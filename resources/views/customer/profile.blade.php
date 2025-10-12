@extends('layouts.customer')
@section('title', 'Edit Profil Saya')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
    <main class="flex-1 overflow-y-auto bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 pb-24">

            <section class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Edit Profil Saya</h2>
                <p class="text-gray-500 mt-1">Perbarui informasi pribadi dan keamanan akun Anda di sini.</p>
            </section>

            <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
 
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                            <h3 class="text-xl font-semibold text-gray-700 mb-4">Foto Profil</h3>

                            <div
                                class="w-32 h-32 rounded-full mx-auto mb-4 overflow-hidden bg-gray-100 flex items-center justify-center">
                                <img id="profileImagePreview"
                                    src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : Avatar::create(Auth::user()->name)->toBase64() }}"
                                    alt="Foto Profil" class="w-full h-full object-cover">
                            </div>

                            <label for="profileImageInput"
                                class="cursor-pointer inline-block bg-primary text-white font-semibold text-sm py-2 px-4 rounded-lg hover:bg-primary-dark transition-colors">
                                Ganti Foto
                            </label>
                            <input type="file" name="avatar" id="profileImageInput" class="hidden"
                                accept="image/png, image/jpeg, image/gif">

                            <p class="text-xs text-gray-500 mt-3">JPG, GIF atau PNG. Ukuran maks 5MB.</p>
                        </div>

                        <div class="mt-3 bg-white p-6 rounded-2xl shadow-sm border border-gray-100 text-center">
                            <h3 class="text-xl font-semibold text-gray-700 mb-6">Status Profil</h3>

                            @php
                                $percentage = Auth::user()->profile_completion_percentage;
                            @endphp

                            <div class="relative w-32 h-32 rounded-full flex items-center justify-center mx-auto"
                                style="background: conic-gradient(var(--color-primary, #5483B3) {{ $percentage * 3.6 }}deg, #E5E7EB 0deg)">
                                <div class="absolute w-28 h-28 bg-white rounded-full"></div>
                                <span class="absolute text-3xl font-bold text-primary">{{ $percentage }}%</span>
                            </div>

                            <p class="text-gray-600 mt-6 text-base">
                                Profil Anda <strong class="text-primary">{{ $percentage }}%</strong> lengkap.
                                @if ($percentage < 100)
                                    Lengkapi sisanya untuk pengalaman terbaik!
                                @else
                                    Terima kasih telah melengkapi profil Anda.
                                @endif
                            </p>
                        </div>

                    </div>

                    <div class="lg:col-span-2">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

                            <h3 class="text-xl font-semibold text-gray-700 mb-6">Informasi Pribadi</h3>
                            <div class="space-y-5">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition"
                                        value="{{ old('name', Auth::user()->name) }}" required>
                                </div>
                                <div>
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Alamat
                                        Email</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                                        value="{{ Auth::user()->email }}" readonly disabled>
                                    <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah.</p>
                                </div>
                                <div>
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Nomor
                                        Telepon</label>
                                    <input type="tel" id="number_phone" name="number_phone"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary transition"
                                        value="{{ old('number_phone', Auth::user()->number_phone) }}"
                                        placeholder="Contoh: 081234567890">
                                </div>
                                <div>
                                    <label for="address" class="block mb-2 text-sm font-medium text-gray-700">Alamat Lengkap (Deskripsi)</label>
                                    <textarea id="address" name="address"
                                        class="block w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary transition"
                                        placeholder="Contoh: Jl. Veteran No. 26, Klojen">{{ old('address', Auth::user()->customer?->address) }}</textarea>
                                </div>

                                <div>
                                    <label for="map-profile" class="block mb-2 text-sm font-medium text-gray-700">Tentukan Titik Lokasi di Peta</label>
                                    <div id="map-profile" style="height: 300px; width: 100%; border-radius: 0.5rem; z-index: 0; position: relative;"></div>
                                    <p class="text-xs text-gray-500 mt-1">Geser pin agar sesuai dengan alamat Anda.</p>
                                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', Auth::user()->customer?->latitude) }}">
                                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', Auth::user()->customer?->longitude) }}">
                                    @error('latitude')<p class="text-red-500 text-xs mt-1">Lokasi di peta wajib diisi untuk melengkapi profil.</p>@enderror
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                                <button type="submit"
                                    class="bg-primary text-white font-bold py-2 px-6 rounded-lg hover:bg-secondary transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileImageInput = document.getElementById('profileImageInput');
            const profileImagePreview = document.getElementById('profileImagePreview');

            if (profileImageInput && profileImagePreview) {
                profileImageInput.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            profileImagePreview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                });
            }

            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            const mapElement = document.getElementById('map-profile');

            const malangCenter = [-7.9666, 112.6326];

            const map = L.map('map-profile', {
                scrollWheelZoom: false,
                zoomControl: false,
                attributionControl: false
            }).setView(malangCenter, 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            let marker = L.marker(malangCenter, { draggable: true }).addTo(map);

            function updateMarkerAndInputs(lat, lng, zoomLevel = 17) {
                const newLatLng = L.latLng(lat, lng);
                marker.setLatLng(newLatLng);
                map.setView(newLatLng, zoomLevel);
                latInput.value = lat;
                lngInput.value = lng;
            }

            if (latInput.value && lngInput.value) {
                const savedLat = parseFloat(latInput.value);
                const savedLng = parseFloat(lngInput.value);
                updateMarkerAndInputs(savedLat, savedLng);
            } else {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const currentLat = position.coords.latitude;
                        const currentLng = position.coords.longitude;
                        updateMarkerAndInputs(currentLat, currentLng);
                    },
                    function() {
                        console.log("Gagal mendapatkan lokasi, menggunakan titik default.");
                    }
                );
            }

            marker.on('dragend', function(event) {
                const position = marker.getLatLng();
                latInput.value = position.lat;
                lngInput.value = position.lng;
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                latInput.value = e.latlng.lat;
                lngInput.value = e.latlng.lng;
            });

            const hint = document.createElement('div');
            hint.id = 'map-hint';
            hint.className = 'absolute inset-0 z-[9999] flex items-center justify-center bg-black/60 text-white text-2xl font-bold opacity-0 pointer-events-none transition-opacity duration-300';
            hint.innerHTML = `<p class="text-center">Gunakan CTRL + scroll untuk<br>memperbesar atau memperkecil peta</p>`;
            mapElement.appendChild(hint);

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
        });
    </script>
@endpush
