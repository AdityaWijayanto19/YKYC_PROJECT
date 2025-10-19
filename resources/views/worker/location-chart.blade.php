@extends('layouts.worker')

@section('title', 'Lokasi Gerobak Worker')

{{--
Jika ada CSS khusus untuk halaman ini, tambahkan di sini.
Contoh:
@push('styles')
<style>
    .custom-dashboard-style {
        ...
    }
</style>
@endpush
--}}

{{-- Mulai bagian konten --}}
@section('content')
    @php
        $workerType = 'Mangkal'; 

        $fixedLocations = [
            'stasiun_ub' => 'Stasiun Universitas Brawijaya',
            'kampus_brawijaya' => 'Gerbang Utama Kampus Brawijaya',
            'stasiun_ui' => 'Stasiun Universitas Indonesia',
            'kantin_fisip_ui' => 'Kantin FISIP UI'
        ];

        $isMapActive = true;
    @endphp

    <div class="relative w-screen h-screen">

        <div id="map" class="w-full h-full">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <div class="flex flex-col items-center">
                    <span class="bg-gray-800 text-white text-xs font-bold px-2 py-1 rounded-md mb-2 shadow-lg">
                        Lokasi Anda
                    </span>
                    <svg class="w-10 h-10 text-blue-600 drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div
            class="absolute top-4 left-4 right-4 md:right-auto md:w-96 bg-white rounded-xl shadow-2xl p-5 border border-gray-200">

            <div class="flex justify-between items-center pb-4 border-b">
                <h2 class="text-lg font-bold text-gray-800">Kontrol Lokasi</h2>
                <label for="map-toggle" class="inline-flex relative items-center cursor-pointer">
                    <input type="checkbox" id="map-toggle" class="sr-only peer" {{ $isMapActive ? 'checked' : '' }}>
                    <div
                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                    </div>
                </label>
            </div>

            <div class="mt-4">
                @if ($workerType == 'Mangkal')
                    <div class="space-y-4">
                        <div class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-2 rounded-lg text-center">
                            Status: Mangkal di Lokasi
                        </div>
                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900">Pilih Lokasi Mangkal
                                Anda:</label>
                            <select id="location"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option selected>Pilih lokasi...</option>
                                @foreach ($fixedLocations as $key => $location)
                                    <option value="{{ $key }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button
                            class="w-full bg-gray-800 text-white font-bold py-2.5 px-4 rounded-lg hover:bg-gray-700 transition duration-300">
                            Set Lokasi Mangkal
                        </button>
                    </div>
                @else
                    <div class="space-y-4">
                        <div class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-2 rounded-lg text-center">
                            Status: Sedang Keliling
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="flex items-center justify-center space-x-2 text-gray-700">
                                <span class="relative flex h-3 w-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                <span class="text-sm font-medium">Pelacakan GPS Realtime Aktif</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Lokasi Anda akan otomatis terupdate di peta untuk
                                customer.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
  
