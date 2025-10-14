@extends('layouts.admin')
@section('title', 'Tambah Pengumuman Baru')

@section('content')
<div class="p-8">
    <header>
        <h1 class="text-3xl font-bold text-navy-dark">Tambah Pengumuman Baru</h1>
        <p class="text-blue-medium mt-1">Isi detail untuk pengumuman yang akan ditampilkan di modal.</p>
    </header>
    <div class="mt-8 bg-white p-8 rounded-2xl shadow-md">
        <form action="{{ route('admin.announcement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.announcement._form')
        </form>
    </div>
</div>
@endsection