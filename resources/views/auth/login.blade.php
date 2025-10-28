<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ya Kotor Ya Cuci</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="h-full font-sans overflow-hidden">
    <x-toastify></x-toastify>
    <div class="min-h-screen flex">

        <div class="hidden lg:flex w-1/2 bg-secondary items-center justify-center p-12 relative overflow-hidden">
            <div class="relative w-full max-w-lg text-center">

                <div class="animate-float">
                    <img src="{{ asset('images/vector-login.svg') }}" alt="Ilustrasi vektor sepatu bersih dan mengkilap"
                        class="w-80 h-auto mx-auto">
                </div>

                <div class="mt-10 relative">
                    <h1 class="text-3xl font-bold text-primary">Sepatu Bersih, Hati Senang.</h1>
                    <p class="text-gray-600 mt-2 max-w-md mx-auto">Kami merawat sepatu kesayangan Anda dengan sentuhan
                        profesional.</p>
                </div>

            </div>
        </div>

        <div class="w-full lg:w-1/2 bg-white flex flex-col justify-center">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto">

                <div class="mb-6">
                    <a href="/" class="text-primary font-bold tracking-wider flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 transition-transform group-hover:-translate-x-1" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <h2 class="text-3xl font-bold text-gray-800">Login ke Akun Anda</h2>
                <p class="text-gray-600 mt-2">
                    Belum punya akun?
                    <a href="/register" class="font-semibold text-primary hover:underline">
                        Buat akun baru
                    </a>
                </p>

                <form method="POST" action="{{ route('login.post') }}" class="mt-8 space-y-6">
                    @csrf

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </span>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full pl-12 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Alamat Email">
                    </div>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-lock text-gray-400"></i>
                        </span>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full pl-12 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Password">
                    </div>

                    <div class="flex justify-end items-center">
                        <a href="#" class="text-sm font-medium text-primary hover:underline">
                            Lupa password?
                        </a>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Login
                        </button>
                    </div>
                </form>

                <div class="my-6 flex items-center">
                    <hr class="flex-grow border-gray-200">
                    <span class="mx-4 text-sm font-medium text-gray-500">atau</span>
                    <hr class="flex-grow border-gray-200">
                </div>

                <div>
                    <a href="{{ route('google.redirect') }}"
                        class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors group">
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
                        <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                            Lanjutkan dengan Google
                        </span>
                    </a>
                </div>
                <div class="mt-8 text-center">
                    <a href="/"
                        class="text-sm text-gray-500 hover:text-primary hover:underline group flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                        Kembali ke Halaman Utama
                    </a>
                </div>
            </div>
        </div>

    </div>

</body>

</html>