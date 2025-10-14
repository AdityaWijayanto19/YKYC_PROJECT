@extends('layouts.admin')
@section('title', 'Edit Pengumuman')

@section('content')
<div class="p-8">
    <header>
        <h1 class="text-3xl font-bold text-navy-dark">Edit Pengumuman</h1>
        <p class="text-blue-medium mt-1">Mengubah detail untuk: <span class="font-semibold">{{ $announcement->title }}</span></p>
    </header>
    <div class="mt-8 bg-white p-8 rounded-2xl shadow-md">
        <form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.announcement._form', ['announcement' => $announcement])
        </form>
    </div>
</div>
@endsection