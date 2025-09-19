<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Ya Kotor Ya Cuci</title>

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3490dc',       // Biru
                    'success': '#38c172',       // Hijau
                    'danger': '#e3342f',        // Merah
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

    {{-- DUMMY DATA: Di controller, Anda akan mengambil data ini dari database --}}
    @php
        $order_history = [
            [
                'id' => 'YKYC-210', 'service' => 'Deep Clean', 'date' => '10 Sep 2025',
                'worker' => 'Gerobak Senayan Park', 'status' => 'Selesai'
            ],
            [
                'id' => 'YKYC-208', 'service' => 'Quick Clean', 'date' => '8 Sep 2025',
                'worker' => 'Gerobak Blok M Square', 'status' => 'Dibatalkan'
            ],
            [
                'id' => 'YKYC-205', 'service' => 'Unyellowing', 'date' => '5 Sep 2025',
                'worker' => 'Gerobak Stasiun Gambir', 'status' => 'Selesai'
            ],
            [
                'id' => 'YKYC-199', 'service' => 'Deep Clean', 'date' => '1 Sep 2025',
                'worker' => 'Gerobak Senayan Park', 'status' => 'Selesai'
            ],
        ];
    @endphp

    <div class="flex h-screen bg-gray-100">
       <x-sidebar-customer></x-sidebar-customer>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
             <!-- Top bar (mobile) -->
             <header class="flex justify-between items-center p-4 bg-white border-b md:hidden">
                <h1 class="text-xl font-bold text-primary">Riwayat Pesanan</h1>
                <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Pesanan Anda</h2>
                    <p class="text-gray-500 mb-8">Lihat semua transaksimu yang telah lalu.</p>
                    
                    <!-- Filter Buttons -->
                    <div class="flex space-x-2 md:space-x-4 mb-6">
                        <button class="filter-btn active" data-filter="semua">Semua</button>
                        <button class="filter-btn" data-filter="selesai">Selesai</button>
                        <button class="filter-btn" data-filter="dibatalkan">Dibatalkan</button>
                    </div>

                    <!-- Order History Grid -->
                    <div id="history-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($order_history as $order)
                            <div class="order-card bg-white p-6 rounded-lg shadow-md transition hover:shadow-xl" data-status="{{ strtolower($order['status']) }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-bold text-lg text-gray-800">{{ $order['service'] }}</p>
                                        <p class="text-sm text-gray-500">ID: {{ $order['id'] }}</p>
                                    </div>
                                    @php
                                        $statusClass = '';
                                        if ($order['status'] == 'Selesai') $statusClass = 'bg-success/20 text-success-800';
                                        elseif ($order['status'] == 'Dibatalkan') $statusClass = 'bg-danger/20 text-danger-800';
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                        {{ $order['status'] }}
                                    </span>
                                </div>
                                <div class="border-t my-4"></div>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Tanggal:</span>
                                        <span class="font-medium text-gray-700">{{ $order['date'] }}</span>
                                    </div>
                                     <div class="flex justify-between">
                                        <span class="text-gray-500">Worker:</span>
                                        <span class="font-medium text-gray-700">{{ $order['worker'] }}</span>
                                    </div>
                                </div>
                                @if ($order['status'] == 'Selesai')
                                    <div class="mt-5">
                                        <button onclick="window.location.href='{{ route('customer.feedback.create') }}'" class="w-full text-primary border border-primary hover:bg-primary/10 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition">
                                            Beri Feedback
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="md:col-span-2 lg:col-span-3 bg-white p-8 text-center rounded-lg shadow-md">
                                <p class="text-gray-600">Anda belum memiliki riwayat pesanan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </main>
        </div>
    </div>

<style>
    /* Custom styles for filter buttons */
    .filter-btn {
        @apply px-4 py-2 text-sm font-semibold text-gray-600 bg-white rounded-full shadow-sm border border-gray-200 hover:bg-gray-50 transition;
    }
    .filter-btn.active {
        @apply bg-primary text-white border-primary;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // ========== Mobile Menu Toggle ==========
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');

    mobileMenuButton.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });

    // ========== Client-Side Filtering Logic ==========
    const filterButtons = document.querySelectorAll('.filter-btn');
    const orderCards = document.querySelectorAll('.order-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Update active state for buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const filterValue = button.dataset.filter;

            // Show or hide cards based on filter
            orderCards.forEach(card => {
                const cardStatus = card.dataset.status;

                if (filterValue === 'semua' || filterValue === cardStatus) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
</body>
</html>