@extends('layouts.customer')
@section('title', 'Notifikasi - Ya Kotor Ya Cuci')

@section('content')
    @php
        $notifications = [
            [
                'icon' => 'check-circle',
                'color' => 'success',
                'read' => false,
                'title' => 'Pesanan #YKYC-215 Selesai!',
                'body' => 'Sepatumu sudah bersih dan siap diambil di Gerobak Stasiun Gambir.',
                'time' => '1 jam yang lalu'
            ],
            [
                'icon' => 'truck',
                'color' => 'primary',
                'read' => false,
                'title' => 'Pesanan #YKYC-221 Sedang Diproses',
                'body' => 'Worker kami sedang membersihkan sepatumu. Pantau statusnya secara berkala.',
                'time' => '3 jam yang lalu'
            ],
            [
                'icon' => 'tag',
                'color' => 'primary',
                'read' => true,
                'title' => 'Promo Spesial Kemerdekaan!',
                'body' => 'Dapatkan diskon 17% untuk layanan Deep Clean hingga akhir bulan Agustus. Jangan sampai ketinggalan!',
                'time' => '2 hari yang lalu'
            ],
            [
                'icon' => 'check-circle',
                'color' => 'success',
                'read' => true,
                'title' => 'Pesanan #YKYC-210 Telah Selesai',
                'body' => 'Terima kasih telah menggunakan jasa kami. Jangan lupa berikan feedback!',
                'time' => '5 hari yang lalu'
            ],
        ];
    @endphp

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="container mx-auto max-w-3xl">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Notifikasi</h2>
                    <p class="text-gray-500">Semua pemberitahuan penting untuk akun Anda.</p>
                </div>
                <button id="mark-all-read-btn" class="text-sm font-semibold text-primary hover:underline">Tandai semua
                    dibaca</button>
            </div>
            <div class="bg-white rounded-lg shadow-md">
                <ul class="divide-y divide-gray-200">
                    @forelse ($notifications as $notification)
                        <li class="notification-item p-4 sm:p-6 @if(!$notification['read']) bg-primary/5 @endif">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    @php
                                        $iconColor = $notification['color'] == 'success' ? 'text-success' : 'text-primary';
                                    @endphp
                                    <span
                                        class="flex items-center justify-center h-10 w-10 rounded-full {{ $iconColor }} bg-gray-100">
                                        @if($notification['icon'] == 'check-circle')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @elseif($notification['icon'] == 'truck')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10l2 2h8l2-2zM5 11h6"></path>
                                            </svg>
                                        @elseif($notification['icon'] == 'tag')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A2 2 0 013 8V5a2 2 0 012-2z">
                                                </path>
                                            </svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800">{{ $notification['title'] }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $notification['body'] }}</p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $notification['time'] }}</p>
                                </div>
                                @if(!$notification['read'])
                                    <div class="unread-indicator flex-shrink-0 flex flex-col items-end gap-2">
                                        <span class="w-2.5 h-2.5 bg-primary rounded-full" title="Belum dibaca"></span>
                                        <button class="mark-one-read-btn text-xs text-primary hover:underline font-semibold">Tandai
                                            dibaca</button>
                                    </div>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="p-8 text-center">
                            <p class="text-gray-500">Tidak ada notifikasi untuk Anda saat ini.</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');

            mobileMenuButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });

            const markAllReadButton = document.getElementById('mark-all-read-btn');
            const markOneReadButtons = document.querySelectorAll('.mark-one-read-btn');

            const markAsRead = (notificationItem) => {
                notificationItem.classList.remove('bg-primary/5');
                const indicator = notificationItem.querySelector('.unread-indicator');
                if (indicator) {
                    indicator.remove();
                }
            };

            markOneReadButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const notificationItem = e.target.closest('.notification-item');
                    markAsRead(notificationItem);
                });
            });

            markAllReadButton.addEventListener('click', () => {
                const unreadItems = document.querySelectorAll('.notification-item.bg-primary/5');
                unreadItems.forEach(item => {
                    markAsRead(item);
                });
            });
        });
    </script>
@endpush