@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')

<div class="p-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Edit Data Customer</h1>
            <p class="text-blue-medium mt-1">Mengubah detail untuk: <span class="font-semibold">{{ $customer['first_name'] }} {{ $customer['last_name'] }}</span></p>
        </div>
    </header>

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-lg font-semibold text-navy-dark mb-4">Profil Customer</h3>
                    <div class="mb-4">
                        <img id="photo-preview" 
                             src="{{ 'https://i.pravatar.cc/150?u='.$customer['email'] }}" 
                             alt="Preview" class="w-32 h-32 rounded-full mx-auto object-cover">
                    </div>
                    
                    <div class="text-center border-t pt-4 mt-4">
                        <p class="text-sm text-blue-light">Tanggal Bergabung</p>
                        <p class="font-semibold text-navy-dark">25 Okt 2023</p>
                        <p class="text-sm text-blue-light mt-2">Total Pesanan</p>
                        <p class="font-semibold text-navy-dark">12</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <h3 class="text-lg font-semibold text-navy-dark mb-6">Informasi Akun</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-blue-medium mb-1">Nama Depan</label>
                            <input type="text" id="first_name" name="first_name" 
                                   value="{{ old('first_name', $customer['first_name'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-blue-medium mb-1">Nama Belakang</label>
                            <input type="text" id="last_name" name="last_name" 
                                   value="{{ old('last_name', $customer['last_name'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                        </div>
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-blue-medium mb-1">Alamat Email</label>
                            <input type="email" id="email" name="email" 
                                   value="{{ old('email', $customer['email'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium" required>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-blue-medium mb-1">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone" 
                                   value="{{ old('phone', $customer['phone'] ?? '') }}"
                                   class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium">
                        </div>
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