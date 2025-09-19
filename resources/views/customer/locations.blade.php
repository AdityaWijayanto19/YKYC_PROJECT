<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Gerobak Aktif - Ya Kotor Ya Cuci</title>

    <!-- TailwindCSS, Fonts, Leaflet CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3490dc',
                    },
                    fontFamily: { 'sans': ['Inter', 'sans-serif'], }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        /* Optional: simple styling for Leaflet popup */
        .leaflet-popup-content-wrapper {
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex h-screen bg-gray-100">
         <x-sidebar-customer></x-sidebar-customer>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <main class="flex-1 p-4 md:p-6">
                <div class="container mx-auto">
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">Lokasi Gerobak Aktif</h1>
                        <p class="text-gray-600 mt-2">Temukan gerobak YKYc yang paling dekat denganmu saat ini.</p>
                    </div>

                    <!-- Map Container -->
                    <div id="map" class="h-[75vh] w-full rounded-lg shadow-md z-10"></div>
                </div>
            </main>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Terima data lokasi yang dikirim dari file route (web.php)
            const locations = @json($active_locations ?? []);

            // Fallback jika tidak ada lokasi
            if (locations.length === 0) {
                document.getElementById('map').innerHTML = `
                <div class="flex items-center justify-center h-full bg-white text-center p-4 rounded-lg">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Tidak Ada Lokasi Aktif</h2>
                        <p class="text-gray-600 mt-2">Maaf, saat ini tidak ada gerobak yang sedang beroperasi.</p>
                    </div>
                </div>
            `;
                return;
            }

            // Inisialisasi peta, berpusat pada lokasi pertama
            const map = L.map('map').setView([locations[0].location.lat, locations[0].location.lng], 13);

            // Tambahkan layer peta dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // ================== PERUBAHAN DI SINI (1/2) ==================
            // Definisikan Custom Icon yang sama seperti di halaman tracking
            const cartIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/3721/3721838.png', // Dummy cart icon
                iconSize: [40, 40],       // ukuran ikon
                iconAnchor: [20, 40],     // titik ikon yang akan menunjuk ke lokasi persis di peta
                popupAnchor: [0, -40]     // titik di mana popup akan muncul relatif terhadap ikon
            });
            // ================== AKHIR PERUBAHAN (1/2) ==================

            // Tambahkan marker untuk setiap lokasi gerobak
            locations.forEach(loc => {
                // ================== PERUBAHAN DI SINI (2/2) ==================
                // Tambahkan opsi { icon: cartIcon } saat membuat marker
                L.marker([loc.location.lat, loc.location.lng], { icon: cartIcon })
                    .addTo(map)
                    .bindPopup(`<b>${loc.worker}</b><br>Status: Aktif`);
                // ================== AKHIR PERUBAHAN (2/2) ==================
            });

            // Opsional: Auto-zoom untuk menampilkan semua marker
            if (locations.length > 1) {
                const markerBounds = L.latLngBounds(locations.map(loc => [loc.location.lat, loc.location.lng]));
                map.fitBounds(markerBounds.pad(0.2));
            }
        });
    </script>

</body>

</html>