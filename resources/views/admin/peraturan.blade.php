@extends('layouts.admin')

@section('title', 'Peraturan & Panduan Admin')

@section('content')
<div class="p-8">
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-navy-dark">Peraturan & Panduan Admin</h1>
        <p class="text-blue-medium mt-1">Panduan untuk menjaga kualitas, keamanan, dan konsistensi platform.</p>
    </header>

    <div class="space-y-8">

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-bold text-navy-dark border-b pb-3 mb-4">Manajemen Data Customer</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <h3 class="font-semibold text-lg text-green-700">Yang Boleh Dilakukan (Do's)</h3>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <p class="text-blue-medium">Jaga kerahasiaan data customer. Informasi seperti alamat dan nomor telepon hanya boleh digunakan untuk keperluan pesanan.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <p class="text-blue-medium">Gunakan fitur "Blokir" hanya jika customer terbukti melakukan pelanggaran serius (misal: penipuan, pelecehan).</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-lg text-red-700">Yang Tidak Boleh Dilakukan (Don'ts)</h3>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <p class="text-blue-medium">Dilarang menyebarkan atau menjual data customer kepada pihak ketiga manapun.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <p class="text-blue-medium">Dilarang menghapus akun customer tanpa alasan yang jelas dan terdokumentasi.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-bold text-navy-dark border-b pb-3 mb-4">Manajemen Konten (Promo & Pengumuman)</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <h3 class="font-semibold text-lg text-green-700">Yang Boleh Dilakukan (Do's)</h3>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <p class="text-blue-medium">Gunakan gambar yang relevan, berkualitas tinggi, dan bebas hak cipta (lisensi gratis).</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <p class="text-blue-medium">Tulis judul dan deskripsi dengan bahasa yang sopan, jelas, dan profesional.</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-lg text-red-700">Yang Tidak Boleh Dilakukan (Don'ts)</h3>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <p class="text-blue-medium">Dilarang mengunggah gambar yang mengandung SARA, kekerasan, atau konten tidak pantas.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <p class="text-blue-medium">Dilarang membuat promo atau pengumuman yang informasinya palsu atau menyesatkan (hoax).</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <h2 class="text-xl font-bold text-navy-dark border-b pb-3 mb-4">Manajemen Pesanan & Layanan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <h3 class="font-semibold text-lg text-green-700">Yang Boleh Dilakukan (Do's)</h3>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <p class="text-blue-medium">Update status pesanan secara real-time sesuai dengan kondisi di lapangan untuk menjaga kepercayaan customer.</p>
                    </div>
                     <div class="flex items-start gap-3">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <p class="text-blue-medium">Pastikan perubahan harga layanan sudah dikomunikasikan dengan baik kepada tim internal sebelum diterapkan.</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <h3 class="font-semibold text-lg text-red-700">Yang Tidak Boleh Dilakukan (Don'ts)</h3>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-times-circle text-red-500 mt-1"></i>
                        <p class="text-blue-medium">Dilarang mengubah status pesanan secara sembarangan tanpa konfirmasi dari worker atau customer terkait.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection