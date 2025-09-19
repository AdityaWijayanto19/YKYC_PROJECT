<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pesanan Baru - Ya Kotor Ya Cuci</title>

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3490dc', // Biru
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
    
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen bg-gray-100">
       <x-sidebar-customer></x-sidebar-customer>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
             <!-- Top bar (mobile) -->
             <header class="flex justify-between items-center p-4 bg-white border-b md:hidden">
                <h1 class="text-xl font-bold text-primary">Buat Pesanan</h1>
                <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Pesanan Baru</h2>
                    <p class="text-gray-500 mb-8">Lengkapi detail di bawah ini untuk membersihkan sepatumu.</p>
                    
                    <!-- Form Card -->
                    <div class="max-w-2xl mx-auto">
                        <div class="bg-white p-8 rounded-xl shadow-lg w-full">
                            <form method="POST" action="{{-- route('order.store') --}}" class="space-y-6">
                                @csrf

                                <!-- 1. Jenis Layanan -->
                                <div>
                                    <label for="service_type" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Jenis Layanan</label>
                                    <select id="service_type" name="service_type" required class="block w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('service_type') border-red-500 @enderror">
                                        <option value="" disabled selected>-- Pilih salah satu --</option>
                                        <option value="Quick Clean">Quick Clean</option>
                                        <option value="Deep Clean">Deep Clean</option>
                                        <option value="Unyellowing">Unyellowing</option>
                                    </select>
                                    @error('service_type')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                                </div>

                                <!-- 2. Metode Pengambilan -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Metode Pengambilan</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <!-- Opsi 1: Datang ke Gerobak -->
                                        <div class="delivery-option-card" data-value="drop-off">
                                            <input type="radio" id="drop-off" name="delivery_method" value="drop-off" class="hidden" checked>
                                            <label for="drop-off" class="block p-4 border rounded-lg cursor-pointer">
                                                <h4 class="font-semibold text-gray-800">Datang ke Gerobak</h4>
                                                <p class="text-sm text-gray-500">Antar sepatumu langsung ke lokasi gerobak kami.</p>
                                            </label>
                                        </div>
                                        <!-- Opsi 2: Jemput-Antar -->
                                        <div class="delivery-option-card" data-value="pickup">
                                            <input type="radio" id="pickup" name="delivery_method" value="pickup" class="hidden">
                                            <label for="pickup" class="block p-4 border rounded-lg cursor-pointer">
                                                <h4 class="font-semibold text-gray-800">Jemput–Antar</h4>
                                                <p class="text-sm text-gray-500">Kami akan menjemput dan mengantar sepatumu.</p>
                                            </label>
                                        </div>
                                    </div>
                                    @error('delivery_method')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                                </div>
                                
                                <!-- 3. Lokasi Gerobak (Conditional) -->
                                <div id="location-section">
                                    <label for="location_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Lokasi Gerobak</label>
                                    <select id="location_id" name="location_id" class="block w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('location_id') border-red-500 @enderror">
                                        <option value="" disabled selected>-- Pilih lokasi terdekat --</option>
                                        <option value="1">Gerobak Senayan Park</option>
                                        <option value="2">Gerobak Blok M Square</option>
                                        <option value="3">Gerobak Stasiun Gambir</option>
                                    </select>
                                    @error('location_id')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                                </div>

                                <!-- 4. Alamat Jemput (Conditional) -->
                                <div id="address-section" class="hidden">
                                    <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap Penjemputan</label>
                                    <textarea id="address" name="address" rows="3" class="block w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('address') border-red-500 @enderror" placeholder="Contoh: Jl. Pahlawan No. 123, RT 01/RW 02, Kel. Suka Maju, Kec. Jaya Raya, Jakarta Pusat, 10110"></textarea>
                                    @error('address')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
                                </div>
                                
                                <!-- Ringkasan Pesanan -->
                                <div class="border-t pt-6 mt-6 space-y-2">
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
                                
                                <!-- Tombol Submit -->
                                <div class="pt-4">
                                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ========== Mobile Menu Toggle ==========
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');

    mobileMenuButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // ========== Form Interactivity ==========
    const serviceSelect = document.getElementById('service_type');
    const deliveryOptionCards = document.querySelectorAll('.delivery-option-card');
    const deliveryRadioButtons = document.querySelectorAll('input[name="delivery_method"]');
    const locationSection = document.getElementById('location-section');
    const addressSection = document.getElementById('address-section');
    
    // Elements for summary
    const summaryService = document.getElementById('summary-service');
    const summaryDeliveryFee = document.getElementById('summary-delivery-fee');
    const summaryTotal = document.getElementById('summary-total');

    const prices = {
        'Quick Clean': 25000,
        'Deep Clean': 45000,
        'Unyellowing': 35000,
        'delivery_fee': 15000
    };

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(number);
    }
    
    function updateSummary() {
        const selectedService = serviceSelect.value;
        const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked').value;

        let servicePrice = prices[selectedService] || 0;
        let deliveryFee = (selectedDelivery === 'pickup') ? prices.delivery_fee : 0;
        let totalPrice = servicePrice + deliveryFee;

        summaryService.textContent = selectedService || '-';
        summaryDeliveryFee.textContent = formatRupiah(deliveryFee);
        summaryTotal.textContent = formatRupiah(totalPrice);
    }
    
    function handleDeliveryChange() {
        const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked').value;
        
        // Update card styles
        deliveryOptionCards.forEach(card => {
            if (card.dataset.value === selectedDelivery) {
                card.querySelector('label').classList.add('border-primary', 'ring-2', 'ring-primary');
            } else {
                card.querySelector('label').classList.remove('border-primary', 'ring-2', 'ring-primary');
            }
        });

        // Show/hide conditional fields
        if (selectedDelivery === 'drop-off') {
            locationSection.style.display = 'block';
            addressSection.style.display = 'none';
        } else { // pickup
            locationSection.style.display = 'none';
            addressSection.style.display = 'block';
        }
        updateSummary();
    }

    // Event listeners
    serviceSelect.addEventListener('change', updateSummary);
    deliveryRadioButtons.forEach(radio => radio.addEventListener('change', handleDeliveryChange));
    deliveryOptionCards.forEach(card => {
        card.addEventListener('click', () => {
            card.querySelector('input[type="radio"]').checked = true;
            // Manually trigger change event
            const changeEvent = new Event('change', { bubbles: true });
            card.querySelector('input[type="radio"]').dispatchEvent(changeEvent);
        });
    });

    // Initial state setup
    handleDeliveryChange();
    updateSummary();
});
</script>
</body>
</html>