@extends('layouts.admin')

@section('title', 'Lokasi Worker Aktif')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        .leaflet-popup-content-wrapper { border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); }
        .leaflet-popup-content { font-family: 'sans-serif'; margin: 13px 20px !important; }
        .leaflet-control-zoom { border-radius: 0.75rem !important; overflow: hidden; }
    </style>
@endpush

@section('content')
<div class="p-8">
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Lokasi Worker Aktif</h1>
            <p class="text-blue-medium mt-1">Lihat lokasi real-time semua worker yang sedang beroperasi.</p>
        </div>
    </header>
    <div class="bg-white p-6 rounded-2xl shadow-md relative">
        <div id="map" class="h-[70vh] w-full rounded-lg z-10"></div>
        <div id="map-hint" class="absolute inset-0 z-[1001] flex items-center justify-center bg-black/60 text-white text-lg font-semibold opacity-0 pointer-events-none transition-opacity duration-300 rounded-lg">
            <p class="text-center px-4">Gunakan CTRL + scroll untuk zoom</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const mapElement = document.getElementById('map');
                if (!mapElement) return;

                const locations = @json($active_locations ?? []);
                const serviceAreaPolygon = @json($serviceAreaPolygon ?? []);

                if (locations.length === 0 && serviceAreaPolygon.length === 0) {
                     mapElement.innerHTML = `<div class="flex items-center justify-center h-full text-center p-4 rounded-lg bg-slate-50"><div><i class="fas fa-map-marked-alt text-4xl text-blue-light mb-4"></i><h2 class="text-xl font-semibold text-navy-dark">Peta Siap</h2><p class="text-blue-medium mt-2">Tidak ada worker aktif atau zona layanan yang bisa ditampilkan saat ini.</p></div></div>`;
                    return;
                }

                const map = L.map('map', { scrollWheelZoom: false, zoomControl: true }).setView([-7.9667, 112.6324], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; Ya Kotor Ya Cuci' }).addTo(map);

                if (serviceAreaPolygon.length > 0) {
                    L.polygon(serviceAreaPolygon, { color: '#052659', weight: 2, dashArray: '5, 5', fillOpacity: 0.05, fillColor: '#052659' }).addTo(map);
                }

                const cartIcon = L.icon({ iconUrl: 'https://cdn-icons-png.flaticon.com/512/3721/3721838.png', iconSize: [40, 40], iconAnchor: [20, 40], popupAnchor: [0, -40] });
                
                locations.forEach(loc => {
                    L.marker([loc.location.lat, loc.location.lng], { icon: cartIcon }).addTo(map).bindPopup(`<b style="color: #052659;">${loc.worker}</b><br>Status: Aktif`);
                });

                const allBounds = L.latLngBounds();
                if (locations.length > 0) {
                    allBounds.extend(L.latLngBounds(locations.map(loc => [loc.location.lat, loc.location.lng])));
                }
                if (serviceAreaPolygon.length > 0) {
                    allBounds.extend(serviceAreaPolygon);
                }
                
                if (allBounds.isValid()) {
                    map.fitBounds(allBounds.pad(0.2));
                }

                const hint = document.getElementById('map-hint');
                map.getContainer().addEventListener('wheel', (e) => {
                    e.preventDefault();
                    if (e.ctrlKey) {
                        hint.classList.remove('opacity-100');
                        hint.classList.add('opacity-0');
                        if (e.deltaY < 0) map.zoomIn(); else map.zoomOut();
                    } else {
                        hint.classList.add('opacity-100');
                        setTimeout(() => hint.classList.remove('opacity-100'), 1500);
                    }
                }, { passive: false });

            } catch (error) {
                console.error("Terjadi error saat menginisialisasi peta:", error);
                document.getElementById('map').innerHTML = `<div class="flex items-center justify-center h-full text-center p-4 rounded-lg bg-red-50 text-red-700"><div><h2 class="text-xl font-semibold">Gagal Memuat Peta</h2><p class="mt-2">Terjadi kesalahan pada skrip. Silakan cek konsol (F12) untuk detail.</p></div></div>`;
            }
        });
    </script>
@endpush