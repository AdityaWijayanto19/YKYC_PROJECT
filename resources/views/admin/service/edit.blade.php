@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<div class="p-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Edit Layanan</h1>
            <p class="text-blue-medium mt-1">Mengubah detail untuk: <span class="font-semibold">{{ $service->name }}</span></p>
        </div>
    </header>

    <div class="bg-white p-8 rounded-2xl shadow-md">
        <form action="{{ route('admin.service.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-blue-medium mb-1">Nama Layanan</label>
                    <input type="text" id="name" name="name" 
                           value="{{ old('name', $service->name) }}"
                           class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium @error('name') border-red-500 @enderror" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-blue-medium mb-1">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-blue-medium mb-1">Harga (Rp)</label>
                    <input type="number" id="price" name="price" 
                           value="{{ old('price', $service->price) }}"
                           class="w-full px-4 py-2 border border-blue-pale rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium @error('price') border-red-500 @enderror" required>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('admin.service.index') }}" class="bg-slate-200 text-slate-800 font-semibold py-2 px-6 rounded-lg hover:bg-slate-300 transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-navy-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-opacity-90 transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection