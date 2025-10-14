@extends('layouts.admin')

@section('title', 'Manajemen Customer')

@section('content')

<div class="p-8">
    <header class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-navy-dark">Manajemen Customer</h1>
            <p class="text-blue-medium mt-1">Lihat, kelola, dan nonaktifkan akun customer.</p>
        </div>
    </header>

    <div class="bg-white p-6 rounded-2xl shadow-md">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <thead>
                    <tr class="border-b bg-slate-50">
                        <th class="py-3 px-4 font-semibold text-blue-medium">NAMA CUSTOMER</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">STATUS</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium">TANGGAL DAFTAR</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium text-center">TOTAL PESANAN</th>
                        <th class="py-3 px-4 font-semibold text-blue-medium text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr class="border-b hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 flex items-center gap-3">
                                <img src="{{ $customer->avatar ?? 'https://i.pravatar.cc/40?u=' . $customer->email }}" class="w-10 h-10 rounded-full object-cover" alt="{{ $customer->name }}">
                                <div>
                                    <p class="font-semibold text-navy-dark">{{ $customer->name }}</p>
                                    <p class="text-sm text-blue-light">{{ $customer->email }}</p>
                                </div>
                            </td>
                            <td class="px-4">
                                {{-- Badge Status yang lebih rapi --}}
                                @if ($customer->status == 'aktif')
                                    <span class="text-sm text-green-800 bg-green-100 px-3 py-1 rounded-full font-semibold">&#9679; Aktif</span>
                                @else
                                    <span class="text-xs text-red-800 bg-red-100 px-3 py-1 rounded-full font-semibold">&#9679; Diblokir</span>
                                @endif
                            </td>
                            <td class="px-4 text-blue-medium">{{ $customer->created_at->format('d M Y') }}</td>
                            <td class="px-4 text-blue-medium text-center font-semibold">{{ $customer->orders_count }}</td>
                            <td class="px-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    {{-- Tombol Blokir / Aktifkan yang disempurnakan --}}
                                    <form action="{{ route('admin.customer.toggleBlock', $customer->id) }}" method="POST" class="inline">
                                        @csrf
                                        @if ($customer->status == 'aktif')
                                            <button type="submit" class="flex items-center gap-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 font-semibold px-3 py-1 rounded-md text-sm transition-colors" title="Blokir Customer">
                                                <i class="fas fa-user-lock"></i>
                                                <span>Blokir</span>
                                            </button>
                                        @else
                                            <button type="submit" class="flex items-center gap-1.5 bg-green-100 hover:bg-green-200 text-green-800 font-semibold px-3 py-1 rounded-md text-sm transition-colors" title="Aktifkan Customer">
                                                <i class="fas fa-user-check"></i>
                                                <span>Aktifkan</span>
                                            </button>
                                        @endif
                                    </form>

                                    {{-- Tombol Hapus yang disempurnakan --}}
                                    <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin MENGHAPUS customer ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center gap-1.5 bg-red-100 hover:bg-red-200 text-red-800 font-semibold px-3 py-1 rounded-md text-sm transition-colors" title="Hapus Customer">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-blue-medium">Belum ada data customer.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection