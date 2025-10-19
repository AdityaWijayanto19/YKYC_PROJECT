@extends('layouts.worker')

@section('title', 'Profil Worker')

@section('content')
<div class="container mx-auto max-w-lg px-4 py-10">
    <header class="mb-6 text-center">
        <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
        <p class="text-gray-600 mt-1">Kelola informasi akun dan lihat performa Anda.</p>
    </header>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="p-8 bg-gray-50 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <div class="flex-shrink-0">
                    @php
                        $avatarUrl = Avatar::create($user->name)->toBase64();
                    @endphp
                    <img class="h-24 w-24 rounded-full object-cover ring-4 ring-white shadow-md"
                         src="{{ $user->worker->profile_picture ?? $avatarUrl }}"
                         alt="Foto profil {{ $user->name }}">
                </div>

                <div class="text-center sm:text-left">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mt-1
                        {{ $user->worker->type == 'Keliling' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                        Worker {{ $user->worker->type }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <h3 class="text-sm font-semibold uppercase text-gray-500 mb-4 text-center">Performa Anda</h3>
            <div class="grid grid-cols-2 gap-4 text-center">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p class="text-3xl font-bold text-gray-800">{{ $user->worker->total_orders ?? 0 }}</p>
                    <p class="text-sm font-medium text-gray-600">Pesanan Selesai</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <div class="flex items-center justify-center">
                        <p class="text-3xl font-bold text-gray-800">{{ $user->worker->average_rating ?? 0 }}</p>
                        <svg class="w-6 h-6 text-yellow-400 ml-1" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-600">Rating Rata-rata</p>
                </div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200">
            <ul class="space-y-4 text-gray-700">
                <li class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    <span class="font-medium">{{ $user->number_phone ?? '-' }}</span>
                </li>
                <li class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="font-medium">{{ $user->email }}</span>
                </li>
                <li class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 12l4.243-4.243a1 1 0 10-1.414-1.414L12 10.586 7.757 6.343a1 1 0 10-1.414 1.414L10.586 12l-4.243 4.243a1 1 0 101.414 1.414L12 13.414l4.243 4.243a1 1 0 001.414-1.414z">
                        </path>
                    </svg>
                    <span class="font-medium">{{ $user->worker->location_name ?? '-' }}</span>
                </li>
            </ul>
        </div>

        <div class="p-6 bg-gray-50 border-t border-gray-200 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="#"
               class="w-full text-center bg-gray-800 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-gray-700 transition duration-300">
               Edit Profil
            </a>
            <a href="#"
               class="w-full text-center bg-gray-200 text-gray-800 font-bold py-2.5 px-4 rounded-lg hover:bg-gray-300 transition duration-300">
               Ubah Password
            </a>
        </div>
    </div>
</div>
@endsection
