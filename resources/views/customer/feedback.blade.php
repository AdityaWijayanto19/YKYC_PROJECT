<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback & Rating - Ya Kotor Ya Cuci</title>

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3490dc',       // Biru
                    'warning': '#f6993f',       // Oranye (untuk bintang)
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

    {{-- DUMMY DATA: Pesanan yang sudah selesai dan belum diberi feedback --}}
    @php
        $orders_to_review = [
            ['id' => 'YKYC-215', 'service' => 'Unyellowing + Deep Clean', 'date' => '14 Sep 2025'],
            ['id' => 'YKYC-210', 'service' => 'Deep Clean', 'date' => '10 Sep 2025'],
        ];
    @endphp

    <div class="flex h-screen bg-gray-100">
        <x-sidebar-customer></x-sidebar-customer>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
             <!-- Top bar (mobile) -->
             <header class="flex justify-between items-center p-4 bg-white border-b md:hidden">
                <h1 class="text-xl font-bold text-primary">Beri Feedback</h1>
                <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                <div class="container mx-auto max-w-2xl">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800">Beri Feedback & Rating</h2>
                        <p class="text-gray-500 mt-2">Bagikan pengalamanmu untuk membantu kami menjadi lebih baik.</p>
                    </div>
                    
                    <!-- Feedback Form List -->
                    <div class="space-y-8">
                        @forelse ($orders_to_review as $order)
                            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                                <form method="POST" action="{{-- route('feedback.store') --}}">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order['id'] }}">

                                    <!-- Order Info -->
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">Pesanan #{{ $order['id'] }}</h3>
                                        <p class="text-sm text-gray-500">{{ $order['service'] }} &bull; Selesai pada {{ $order['date'] }}</p>
                                    </div>
                                    
                                    <div class="border-t my-6"></div>

                                    <!-- Star Rating -->
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">Rating Anda</label>
                                        <div class="star-rating-container flex items-center space-x-1">
                                            <input type="hidden" name="rating" value="0" required>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="star w-8 h-8 cursor-pointer text-gray-300" data-value="{{ $i }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            @endfor
                                        </div>
                                    </div>

                                    <!-- Comment -->
                                    <div class="mt-6">
                                        <label for="comment-{{ $order['id'] }}" class="block text-sm font-semibold text-gray-700 mb-2">
                                            Komentar (Opsional)
                                        </label>
                                        <textarea id="comment-{{ $order['id'] }}" name="comment" rows="4" class="block w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Ceritakan pengalamanmu..."></textarea>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mt-6">
                                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center py-2.5 px-6 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                            Kirim Feedback
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <div class="bg-white p-8 text-center rounded-lg shadow-md">
                                <p class="text-gray-600">Tidak ada pesanan yang perlu diberi feedback saat ini.</p>
                                <a href="{{-- route('order.history') --}}" class="mt-4 inline-block text-primary hover:underline font-semibold">Lihat Riwayat Pesanan</a>
                            </div>
                        @endforelse
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

    // ========== Interactive Star Rating Logic ==========
    const ratingContainers = document.querySelectorAll('.star-rating-container');

    ratingContainers.forEach(container => {
        const stars = container.querySelectorAll('.star');
        const ratingInput = container.querySelector('input[name="rating"]');

        const setActiveStars = (ratingValue) => {
            stars.forEach(star => {
                if (star.dataset.value <= ratingValue) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-warning');
                } else {
                    star.classList.remove('text-warning');
                    star.classList.add('text-gray-300');
                }
            });
        };

        stars.forEach(star => {
            // Highlight stars on hover
            star.addEventListener('mouseover', () => {
                setActiveStars(star.dataset.value);
            });

            // Revert to selected rating on mouse leave
            container.addEventListener('mouseleave', () => {
                setActiveStars(ratingInput.value);
            });

            // Set rating on click
            star.addEventListener('click', () => {
                ratingInput.value = star.dataset.value;
                setActiveStars(ratingInput.value);
            });
        });
    });
});
</script>
</body>
</html>