@extends('layouts.customer')
@section('title', 'Beri Feedback - Ya Kotor Ya Cuci')

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 pb-16">
        <div class="container mx-auto max-w-2xl">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Beri Feedback & Rating</h2>
                <p class="text-gray-500 mt-2">Bagikan pengalamanmu untuk membantu kami menjadi lebih baik.</p>
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg">
                <form method="POST" action="{{ route('customer.feedback.store') }}">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Pesanan #{{ $order->order_id }}</h3>
                        <p class="text-sm text-gray-500">{{ $order->service->name }} &bull; Selesai pada
                            {{ $order->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div class="border-t my-6"></div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Rating Anda</label>
                        <div class="star-rating-container flex items-center space-x-1">
                            <input type="hidden" name="rating" value="0" required>
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="star w-8 h-8 cursor-pointer text-gray-300" data-value="{{ $i }}" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="comment-{{ $order->id }}" class="block text-sm font-semibold text-gray-700 mb-2">
                            Komentar (Opsional)
                        </label>
                        <textarea id="comment-{{ $order->id }}" name="comment" rows="4"
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Ceritakan pengalamanmu..."></textarea>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex justify-center py-2.5 px-6 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Kirim Feedback
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');

            if (mobileMenuButton && sidebar) {
                mobileMenuButton.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                });
            }

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
                    star.addEventListener('mouseover', () => {
                        setActiveStars(star.dataset.value);
                    });

                    container.addEventListener('mouseleave', () => {
                        setActiveStars(ratingInput.value);
                    });

                    star.addEventListener('click', () => {
                        ratingInput.value = star.dataset.value;
                        setActiveStars(ratingInput.value);
                    });
                });
            });
        });
    </script>
@endpush