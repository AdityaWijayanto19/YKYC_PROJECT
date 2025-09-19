<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Lokasi Gerobak - Ya Kotor Ya Cuci</title>

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3490dc',
                },
                fontFamily: {
                    'sans': ['Inter', 'sans-serif'],
                }
            }
        }
    }
    </script>

    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Leaflet.js for Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha266-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        /* Make the map container take the full viewport height */
        #map { height: 100vh; }
        /* Simple styling for Leaflet popup */
        .leaflet-popup-content-wrapper {
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); /* shadow-md */
        }
    </style>
</head>
<body class="font-sans">
    
    <!-- Map container will take the full screen -->
    <div id="map" class="z-10"></div>

    <!-- Floating Header/Info Panel -->
    <div class="absolute top-0 left-0 right-0 z-20 p-4 md:p-6">
        <div class="max-w-md mx-auto bg-white/90 backdrop-blur-sm p-4 rounded-xl shadow-lg">
             <div class="flex items-center gap-4">
                <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-primary p-2 rounded-full transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div class="flex-1">
                    <h1 class="text-xl font-bold text-gray-800">Lacak Gerobak Anda</h1>
                    <p class="text-sm text-gray-600">Lokasi real-time untuk pesanan aktif Anda.</p>
                </div>
             </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Pass PHP data (as JSON) from the ROUTE to JavaScript
    // Variabel $tracked_orders sekarang hanya berisi data SPESIFIK yang dikirim dari web.php
    const orders = @json($tracked_orders ?? []);

    // Filter out orders that don't have location data
    const locations = orders.filter(order => order.location && order.location.lat && order.location.lng);

    if (locations.length === 0) {
        // Handle the case where no locations are available to track
        document.getElementById('map').innerHTML = `
            <div class="flex items-center justify-center h-full bg-gray-200 text-center p-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Lokasi Tidak Ditemukan</h2>
                    <p class="text-gray-600 mt-2">Maaf, lokasi untuk pesanan ini tidak dapat dilacak saat ini.</p>
                </div>
            </div>
        `;
        return;
    }

    // Initialize map, centered on the first available location
    const initialCoords = [locations[0].location.lat, locations[0].location.lng];
    const map = L.map('map').setView(initialCoords, 14);

    // Add Tile Layer from OpenStreetMap (free to use)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Define a custom Icon for the cart marker
    const cartIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/3721/3721838.png', // Dummy cart icon
        iconSize: [40, 40],       // size of the icon
        iconAnchor: [20, 40],     // point of the icon which will correspond to marker's location
        popupAnchor: [0, -40]     // point from which the popup should open relative to the iconAnchor
    });

    // Loop through all locations (sekarang seharusnya hanya satu) and add a marker for each
    locations.forEach(order => {
        const marker = L.marker([order.location.lat, order.location.lng], { icon: cartIcon }).addTo(map);

        // Create the content for the popup
        const popupContent = `
            <div class="font-sans">
                <h3 class="font-bold text-base mb-1">${order.worker}</h3>
                <p class="text-sm text-gray-600">Pesanan: <span class="font-semibold">${order.order_id}</span></p>
                <p class="text-sm text-gray-600">Status: <span class="font-semibold">${order.status}</span></p>
            </div>
        `;

        marker.bindPopup(popupContent).openPopup(); // .openPopup() agar langsung terlihat
    });

    // Optional: Automatically adjust map zoom to show all markers at once
    if (locations.length > 1) {
        const markerBounds = L.latLngBounds(locations.map(order => [order.location.lat, order.location.lng]));
        map.fitBounds(markerBounds.pad(0.2));
    }
});
</script>

</body>
</html>