<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Buat Akun - Ya Kotor Ya Cuci</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 'primary': '#3490dc' },
                    fontFamily: { 'sans': ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        .swiper-slide {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="font-sans">

    <div class="min-h-screen md:flex">

        <div class="hidden md:block md:w-1/2 relative bg-cover bg-center h-screen"
            style="background-image: url('https://i.pinimg.com/1200x/a3/e1/ce/a3e1ceb20b3cb96d1317472e1aa8235a.jpg');">
            <div class="p-12 flex flex-col justify-between h-full">
                <div class="absolute inset-0 bg-black opacity-20"></div>
            </div>
            <div class="absolute inset-0 bg-black opacity-25"></div>
            <div class="absolute inset-0 p-12 flex flex-col justify-end">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white leading-tight">Mulai Petualangan Bersih Anda.</h2>
                    <p class="text-white text-opacity-90 mt-2 text-lg">Daftar sekarang untuk mendapatkan layanan cuci terbaik kami.</p>
                </div>
            </div>
        </div>

        <!-- Right side with Registration Form -->
        <!-- PERUBAHAN FINAL DI SINI: 'min-h-0' ditambahkan -->
        
        <div class="w-full md:w-1/2 bg-white flex flex-col h-screen overflow-y-auto min-h-0">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto my-auto">
                <!-- Back Button -->
                <div class="mb-6">
                    <a href="/" class="text-primary font-bold tracking-wider flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Kembali
                    </a>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="text-gray-600 mt-2">
                    Sudah punya akun?
                    <a href="/login" class="font-semibold text-primary hover:underline">
                        Login di sini
                    </a>
                </p>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}" class="mt-8 space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" required value="{{ old('name') }}"
                            class="block w-full px-4 py-3 rounded-lg bg-gray-50 border placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="block w-full px-4 py-3 rounded-lg bg-gray-50 border placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="contoh@email.com">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="block w-full px-4 py-3 rounded-lg bg-gray-50 border placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Buat password">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="block w-full px-4 py-3 rounded-lg bg-gray-50 border placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Konfirmasi password Anda">
                    </div>

                    <div class="flex items-center pt-2">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">Saya setuju dengan <a href="#"
                                class="font-medium text-primary hover:underline">Syarat & Ketentuan</a></label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Buat Akun
                        </button>
                    </div>
                </form>

                <div class="my-6 flex items-center">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-4 text-sm font-medium text-gray-500">Atau daftar dengan</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('google.redirect') }}"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo" class="h-5 w-5">
                        <span class="text-sm font-medium text-gray-700">Daftar dengan Google</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            effect: 'fade',
            fadeEffect: { crossFade: true },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });
    </script>

</body>
</html>