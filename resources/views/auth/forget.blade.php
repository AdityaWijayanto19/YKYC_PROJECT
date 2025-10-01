<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Ya Kotor Ya Cuci</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Toastify JS for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        // Tailwind CSS Configuration
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#3490dc', // Warna biru
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* Custom styles can be added here if needed */
    </style>
</head>

<body class="font-sans">

    <div class="min-h-screen md:flex">
        
        <!-- Panel Gambar (Kiri) -->
        <div id="image-container" class="hidden md:block md:w-1/2 relative bg-cover bg-center">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="p-12 flex flex-col justify-end h-full relative z-10">
                <div>
                    <h2 class="text-3xl font-bold text-white">Lupa Password Anda?</h2>
                    <p class="text-white text-opacity-90 mt-2">Jangan khawatir, kami akan bantu Anda membuat password baru.</p>
                </div>
            </div>
        </div>

        <!-- Panel Form (Kanan) -->
        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto">
                
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="/login" class="text-primary font-bold tracking-wider flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Kembali ke Login
                    </a>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Reset Password Anda</h1>
                <p class="text-gray-600 mt-2">
                    Masukkan alamat email yang terhubung dengan akun Anda, dan kami akan mengirimkan tautan untuk mereset password Anda.
                </p>

                <form method="POST" action="{{-- route('password.email') --}}" class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="block w-full px-4 py-3 rounded-lg bg-gray-50 border placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="contoh@email.com">
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Kirim Tautan Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Daftar URL gambar Anda. Ganti dengan gambar-gambar yang Anda inginkan.
            const imageUrls = [
                'https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1974&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=1974&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012&auto=format&fit=crop'
            ];

            // Pilih elemen kontainer gambar
            const imageContainer = document.getElementById('image-container');

            // Pilih gambar acak dari daftar
            const randomIndex = Math.floor(Math.random() * imageUrls.length);
            const randomImage = imageUrls[randomIndex];

            // Atur sebagai gambar latar belakang
            if (imageContainer) {
                imageContainer.style.backgroundImage = `url('${randomImage}')`;
            }
        });
    </script>

</body>

</html>