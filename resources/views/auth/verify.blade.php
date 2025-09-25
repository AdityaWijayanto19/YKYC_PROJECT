<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Ya Kotor Ya Cuci</title>

    {{-- Semua script dan link ini disalin persis dari file register Anda untuk konsistensi --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3490dc', // Warna biru utama Anda
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-sans">

    <div class="min-h-screen md:flex">

        {{-- BAGIAN KIRI (GAMBAR): Disalin persis, tidak ada perubahan --}}
        <div class="hidden md:block md:w-1/2 relative bg-cover bg-center h-screen"
            style="background-image: url('https://i.pinimg.com/1200x/a3/e1/ce/a3e1ceb20b3cb96d1317472e1aa8235a.jpg');">
            <div class="p-12 flex flex-col justify-between h-full">
                <div class="absolute inset-0 bg-black opacity-20"></div>

                <div class="relative z-10">
                    <a href="/" class="text-3xl font-bold text-white tracking-wider"><--</a>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold text-white">Satu Langkah Lagi Menuju Akun Aktif.</h2>
                    <p class="text-white text-opacity-90 mt-2">Kami perlu memastikan email ini benar-benar milik Anda.
                    </p>
                </div>
            </div>
        </div>

        {{-- BAGIAN KANAN (KONTEN UTAMA): Diadaptasi untuk halaman verifikasi --}}
        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center h-screen overflow-y-auto">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Verifikasi Alamat Email Anda</h1>
                <p class="text-gray-600 mt-4">
                    Sebelum melanjutkan, mohon periksa kotak masuk email Anda untuk link verifikasi.
                </p>

                {{-- Pesan sukses ini akan muncul jika pengguna mengklik tombol "kirim ulang" --}}
                {{-- Gayanya diadaptasi dari pesan error Anda, tapi dengan warna hijau untuk sukses --}}
                @if (session('resent'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg my-4 text-sm" role="alert">
                        Link verifikasi baru telah berhasil dikirimkan ke alamat email Anda.
                    </div>
                @endif


                <div class="mt-8 text-gray-600">
                    Jika Anda tidak menerima email,
                    
                    {{-- Form untuk mengirim ulang email. Tombolnya dibuat agar terlihat seperti link biasa --}}
                    <form class="inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="font-semibold text-primary hover:underline p-0 m-0 bg-transparent border-none cursor-pointer">
                            klik di sini untuk meminta lagi
                        </button>.
                    </form>
                </div>

                {{-- Tombol Logout, jika pengguna ingin keluar daripada verifikasi --}}
                <div class="mt-6">
                     <form method="POST" action="{{ route('logout.post') }}">
                        @csrf
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>