@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')

{{-- 
    Di aplikasi nyata, variabel $customer akan dikirim dari Controller.
    Untuk prototyping, kita akan membuatnya di sini agar form terisi.
--}}
@php
    $customer = [
        'first_name' => 'Indah',
        'last_name' => 'Sari',
        'email' => 'indah.s@example.com',
        'phone' => '081234567890',
        'status' => 'aktif',
    ];
@endphp

<div class="p-8">
    {{-- HEADER HALAMAN --}}
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Edit Data Customer</h1>
            <p class="text-blue-medium mt-1">Mengubah detail untuk: <span class="font-semibold">{{ $customer['first_name'] }} {{ $customer['last_name'] }}</span></p>
        </div>
    </header>

    {{-- =============================================== --}}
    {{-- KODE FORM LANGSUNG DI SINI (TANPA @include) --}}
    {{-- =============================================== --}}
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Method untuk update --}}

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Kolom Kiri: Info Profil & Ringkasan --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-lg font-semibold text-navy-dark mb-4">Profil Customer</h3>
                    <!-- Photo Preview -->
                    <div class="mb-4">
                        <img id="photo-preview" 
                             src="{{ 'https://i.pravatar.cc/150?u='.$customer['email'] }}" 
                             alt="Preview" class="w-32 h-32 rounded-full mx-auto object-cover">
                    </div>
                    
                    {{-- Info yang tidak bisa diedit --}}
                    <div class="text-center border-t pt-4 mt-4">
                        <p class="text-sm text-blue-light">Tanggal Bergabung</p>
                        <p class="font-semibold text-navy-dark">25 Okt 2023</p>
                        <p class="text-sm text-blue-light mt-2">Total Pesanan</p>
                        <p class="font-semibold text-navy-dark">12</p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Detail Data yang Bisa Diedit --}}
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-lg font-semibold text-navy-dark mb-6">Informasi Akun</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Depan -->
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-blue-medium mb-1">Nama Depan</label>
                            <input type="text" id="first_name" name="first_name" 
                                   value="{{ old('first_name', $customer['first_name'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                        </div>
                        <!-- Nama Belakang -->
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-blue-medium mb-1">Nama Belakang</label>
                            <input type="text" id="last_name" name="last_name" 
                                   value="{{ old('last_name', $customer['last_name'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                        </div>
                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-blue-medium mb-1">Alamat Email</label>
                            <input type="email" id="email" name="email" 
                                   value="{{ old('email', $customer['email'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                        </div>
                         <!-- Nomor Telepon -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-blue-medium mb-1">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" 
                                   value="{{ old('phone', $customer['phone'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                        </div>
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-blue-medium mb-1">Status Akun</label>
                            <select id="status" name="status" class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                                <option value="aktif" {{ old('status', $customer['status'] ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $customer['status'] ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                <option value="diblokir" {{ old('status', $customer['status'] ?? '') == 'diblokir' ? 'selected' : '' }}>Diblokir</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('admin.customer.index') }}" class="bg-slate-200 text-slate-800 font-semibold py-2 px-6 rounded-lg hover:bg-slate-300 transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-navy-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-opacity-90 transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection