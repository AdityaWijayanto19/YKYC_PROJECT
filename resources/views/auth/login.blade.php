<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ya Kotor Ya Cuci</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Toastify JS for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Swiper JS for Carousel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
        /* Custom styles for Swiper slides to have cover effect */
        .swiper-slide {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="font-sans">

    <div class="min-h-screen md:flex">

        <!-- Left side with Image Carousel -->
        <div class="hidden md:block md:w-1/2 relative h-screen">
            <!-- Swiper Carousel -->
            <div class="swiper h-full w-full">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide"
                        style="background-image: url('https://images.unsplash.com/photo-1582735689369-4fe89db7957e?q=80&w=1887&auto=format&fit=crop');">
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide"
                        style="background-image: url('https://images.unsplash.com/photo-1626806819282-2c1dc01a5e0c?q=80&w=1887&auto=format&fit=crop');">
                    </div>
                    <!-- Slide 3 -->
                    <div class="swiper-slide"
                        style="background-image: url('https://images.unsplash.com/photo-1601121141499-17ae80afc03a?q=80&w=1887&auto=format&fit=crop');">
                    </div>
                </div>
            </div>

            <!-- Overlay Content -->
            <div class="absolute inset-0 bg-black opacity-25"></div>
            <div class="absolute inset-0 p-12 flex flex-col justify-end">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white leading-tight">Selamat Datang Kembali!</h2>
                    <p class="text-white text-opacity-90 mt-2 text-lg">Masukkan detail akun Anda untuk melanjutkan.</p>
                </div>
            </div>
        </div>


        <!-- Right side with Login Form -->
        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center h-screen overflow-y-auto">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto">

                <!-- Back Button -->
                <div class="mb-6">
                    <a href="/" class="text-primary font-bold tracking-wider flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Login ke Akun Anda</h1>
                <p class="text-gray-600 mt-2">
                    Belum punya akun?
                    <a href="/register" class="font-semibold text-primary hover:underline">
                        Buat akun di sini
                    </a>
                </p>

                {{-- @if ($errors->has('login'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg my-4" role="alert">
                    {{ $errors->first('login') }}
                </div>
                @endif --}}

                <form method="POST" action="{{ route('login.post') }}" class="mt-8 space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="block w-full px-4 py-3 rounded-lg bg-gray-50 border placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="contoh@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <a href="{{-- route('password.request') --}}"
                                class="text-sm font-medium text-primary hover:underline">
                                Lupa password?
                            </a>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="••••••••">
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Login
                        </button>
                    </div>
                </form>

                <div class="my-6 flex items-center">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-4 text-sm font-medium text-gray-500">Atau masuk dengan</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                <div class="flex justify-center">
                    <a href="{{ route('google.redirect') }}"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#FFC107"
                                d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z">
                            </path>
                            <path fill="#FF3D00"
                                d="M6.306 14.691l6.057 4.844C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691z">
                            </path>
                            <path fill="#4CAF50"
                                d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.223 0-9.657-3.657-11.303-8H6.697v5.309C9.72 39.923 16.225 44 24 44z">
  
                          </path>
                            <path fill="#1976D2"
                                d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.087 5.571l6.19 5.238C42.022 35.798 44 30.291 44 24c0-1.341-.138-2.65-.389-3.917z">
                            </path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700">Lanjutkan dengan Google</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Initialize Swiper Carousel
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            loop: true,
            effect: 'fade', // Use fade effect for smooth transition
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 4000, // Change image every 4 seconds
                disableOnInteraction: false,
            },
        });

        // Your existing script for Toastify notifications
        document.addEventListener("DOMContentLoaded", function () {
            {{--
            @if ($errors->has('login'))
                Toastify({
                    text: "{{ $errors->first('login') }}",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: 'red',
                }).showToast();
            @endif

            @if (session('success'))
                Toastify({
                    text: "{{ session('success') }}",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "green",
                }).showToast();
            @endif
            --}}
        });
    </script>
</body>

</html>