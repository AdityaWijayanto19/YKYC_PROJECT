@extends('layouts.admin')

@section('title', 'Edit Worker')

@section('content')

{{-- 
    Di aplikasi nyata, variabel $worker akan dikirim dari Controller.
    Untuk prototyping, kita akan membuatnya di sini.
--}}
@php
    $worker = [
        'first_name' => 'Budi',
        'last_name' => 'Santoso',
        'email' => 'budi.s@example.com',
        'type' => 'keliling',
        'status' => 'aktif',
    ];
@endphp

<div class="p-8">
    {{-- HEADER HALAMAN --}}
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Edit Data Worker</h1>
            <p class="text-blue-medium mt-1">Mengubah detail untuk: <span class="font-semibold">{{ $worker['first_name'] }} {{ $worker['last_name'] }}</span></p>
        </div>
    </header>

    {{-- Memanggil form parsial DAN mengirimkan data worker --}}
    @include('admin.worker._form', ['worker' => $worker])

</div>

@endsection