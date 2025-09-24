@extends('layouts.admin')

@section('title', 'Tambah Worker Baru')

@section('content')

<div class="p-8">
    {{-- HEADER HALAMAN --}}
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Tambah Worker Baru</h1>
            <p class="text-blue-medium mt-1">Isi detail worker pada form di bawah ini.</p>
        </div>
    </header>

    {{-- Memanggil form parsial tanpa mengirimkan data worker --}}
    @include('admin.worker._form')

</div>

@endsection