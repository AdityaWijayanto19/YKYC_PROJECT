@extends('layouts.admin')
@section('title', 'Edit Worker')

@section('content')
<div class="p-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Edit Data Worker</h1>
            <p class="text-blue-medium mt-1">Mengubah detail untuk: <span class="font-semibold">{{ $user->name }}</span></p>
        </div>
    </header>

    @include('admin.worker._form', ['user' => $user])
</div>
@endsection