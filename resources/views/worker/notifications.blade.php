@extends('layouts.worker')

@section('title', 'Notifikasi - Worker')

@section('content')
<div class="container mx-auto max-w-2xl px-4 py-8">
    <header class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Notifikasi</h1>
    </header>

    <div class="space-y-6">
        <div class="space-y-3">
            @forelse ($notifications as $notification)
                <div class="flex items-start p-4 rounded-lg {{ !$notification->is_read ? 'bg-white shadow' : 'bg-gray-50' }}">
                    <div class="ml-4 flex-grow">
                        <p class="text-sm font-semibold text-gray-900">{{ $notification->title }}</p>
                        <p class="text-sm text-gray-600">{{ $notification->message }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @if (!$notification->is_read)
                        <div class="flex-shrink-0 ml-4 mt-1">
                            <div class="h-2.5 w-2.5 rounded-full bg-blue-500" title="Belum dibaca"></div>
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center p-8 bg-white rounded-lg shadow">
                    <p class="text-gray-500">Tidak ada notifikasi untuk Anda saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</div>
@endsection