@extends('layouts.admin')

@section('title', 'Lokasi Gerobak Aktif')

@push('styles')
    {{-- Memuat CSS Leaflet khusus untuk halaman ini --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        /* Styling untuk popup agar konsisten */
        .leaflet-popup-content-wrapper {
            border-radius: 0.75rem; /* rounded-xl */
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        .leaflet-popup-content {
            font-family: 'sans-serif'; /* Pastikan font konsisten */
        }
    </style>
@endpush

@section('content')

<div class="p-8">
    {{-- =============================================== --}}
    {{-- HEADER HALAMAN (KONSISTEN) --}}
    {{-- =============================================== --}}
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Lokasi Gerobak Aktif</h1>
            <p class="text-blue-medium mt-1">Lihat lokasi real-time semua worker yang sedang beroperasi.</p>
        </div>
    </header>

    {{-- =============================================== --}}
    {{-- KONTEN UTAMA (PETA) --}}
    {{-- =============================================== --}}
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <!-- Map Container -->
        <div id="map" class="h-[70vh] w-full rounded-lg z-10"></div>
    </div>
</div>

@endsection

@push('scripts')
    {{-- Memuat JS Leaflet, HARUS SEBELUM script custom kita --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    {{-- Script custom untuk inisialisasi peta --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Terima data lokasi yang dikirim dari Controller
            const locations = @json($active_locations ?? []);

            // Fallback jika tidak ada lokasi
            if (locations.length === 0) {
                document.getElementById('map').innerHTML = `
                    <div class="flex items-center justify-center h-full text-center p-4 rounded-lg bg-slate-50">
                        <div>
                            <i class="fas fa-map-marker-slash text-4xl text-blue-light mb-4"></i>
                            <h2 class="text-xl font-semibold text-navy-dark">Tidak Ada Lokasi Aktif</h2>
                            <p class="text-blue-medium mt-2">Maaf, saat ini tidak ada worker yang sedang beroperasi.</p>
                        </div>
                    </div>`;
                return;
            }

            // Inisialisasi peta, berpusat pada lokasi pertama
            const map = L.map('map').setView([locations[0].location.lat, locations[0].location.lng], 13);

            // Tambahkan layer peta dari OpenStreetMap (bisa diganti tema lain jika mau)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Definisikan Custom Icon
            const cartIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/3721/3721838.png', // Anda bisa ganti dengan ikon custom
                iconSize: [40, 40],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            });

            // Tambahkan marker untuk setiap lokasi gerobak
            locations.forEach(loc => {
                L.marker([loc.location.lat, loc.location.lng], { icon: cartIcon })
                    .addTo(map)
                    .bindPopup(`<b style="color: #052659;">${loc.worker}</b><br>Status: Aktif`);
            });

            // Opsional: Auto-zoom untuk menampilkan semua marker
            if (locations.length > 1) {
                const markerBounds = L.latLngBounds(locations.map(loc => [loc.location.lat, loc.location.lng]));
                map.fitBounds(markerBounds.pad(0.2)); // pad(0.2) memberi sedikit padding
            }
        });
    </script>
@endpush