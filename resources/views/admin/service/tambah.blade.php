@extends('layouts.admin')

@section('title', 'Tambah Layanan Baru')

@section('content')
<div class="p-8">
    <header>
        <h1 class="text-3xl font-bold text-navy-dark">Tambah Layanan Baru</h1>
        <p class="text-blue-medium mt-1">Isi detail untuk layanan yang akan ditawarkan kepada customer.</p>
    </header>

    <div class="mt-8 bg-white p-8 rounded-2xl shadow-md">
        <form action="{{ route('admin.service.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-blue-medium mb-1">Nama Layanan</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium @error('name') border-red-500 @enderror" required>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-blue-medium mb-1">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-blue-medium mb-1">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-medium @error('price') border-red-500 @enderror" required>
                    @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-4">
                <a href="{{ route('admin.service.index') }}" class="bg-slate-200 text-slate-800 font-semibold py-2 px-6 rounded-lg hover:bg-slate-300">Batal</a>
                <button type="submit" class="bg-navy-primary text-white font-semibold py-2 px-6 rounded-lg hover:bg-opacity-90">Simpan Layanan</button>
            </div>
        </form>
    </div>
</div>
@endsection