@extends('layouts.customer')
@section('title', 'Notifikasi - Ya Kotor Ya Cuci')

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
        <div class="container mx-auto max-w-3xl">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Notifikasi</h2>
                    <p class="text-gray-500">Semua pemberitahuan penting untuk akun Anda.</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md">
                <ul class="divide-y divide-gray-200">
                    @forelse ($notifications as $notification)
                        <li class="p-4 sm:p-6 @if(!$notification->is_read) bg-primary/5 @endif">
                            <div class="flex items-start gap-4">
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800">{{ $notification->title }}</p>
                                    <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                @if(!$notification->is_read)
                                    <div class="unread-indicator flex-shrink-0">
                                        <span class="w-2.5 h-2.5 bg-primary rounded-full" title="Belum dibaca"></span>
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
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        </div>
    </main>
@endsection