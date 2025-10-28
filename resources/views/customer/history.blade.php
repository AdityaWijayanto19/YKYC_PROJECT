@extends('layouts.customer')
@section('title', 'Riwayat Pesanan - Ya Kotor Ya Cuci')

@section('content')
 <x-toastify></x-toastify>
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 pb-36">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Riwayat Pesanan Anda</h2>
            <p class="text-gray-500 mb-8">Lihat semua transaksimu yang telah lalu.</p>

            <div class="flex space-x-2 md:space-x-4 mb-6">
                <button class="filter-btn active hover:underline text-primary hover:text-teal-medium"
                    data-filter="semua">Semua</button>
                <button class="filter-btn hover:underline text-primary hover:text-teal-medium"
                    data-filter="completed">Selesai</button>
                <button class="filter-btn hover:underline text-primary hover:text-teal-medium"
                    data-filter="cancelled">Dibatalkan</button>
            </div>

            <div id="history-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($history as $order)
                    <div class="order-card bg-white p-6 rounded-lg shadow-md transition hover:shadow-xl"
                        data-status="{{ strtolower($order->status->name) }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-bold text-lg text-gray-800">
                                    {{ $order->service->name ?? 'Layanan Tidak Ditemukan' }}</p>
                                <p class="text-sm text-gray-500">ID: {{ $order->order_id }}</p>
                            </div>
                            @php
                                $statusClass = '';
                                if (strtolower($order->status->name) == 'completed') {
                                    $statusClass = 'bg-green-100 text-green-700'; 
                                } elseif (strtolower($order->status->name) == 'cancelled') {
                                    $statusClass = 'bg-red-100 text-red-700'; 
                                }
                            @endphp
                            <span class="px-3 py-1 text-xs font-semibold rounded-full capitalize {{ $statusClass }}">
                                {{ $order->status->label ?? $order->status->name }}
                            </span>
                        </div>
                        <div class="border-t my-4"></div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Tanggal:</span>
                                <span class="font-medium text-gray-700">{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Worker:</span>
                                <span class="font-medium text-gray-700">{{ $order->worker->user->name ?? 'N/A' }}</span>
                            </div>
                        </div>
                        
                        @if (strtolower($order->status->name) == 'completed')
                            <div class="mt-5">
                              <a href="{{ route('customer.feedback.create', ['orderId' => $order->id]) }}"
                                class="block w-full text-primary border border-primary hover:bg-primary/10 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition">
                                    Beri Feedback
                            </a>
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
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const orderCards = document.querySelectorAll('.order-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    const filterValue = button.dataset.filter;

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
@endpush