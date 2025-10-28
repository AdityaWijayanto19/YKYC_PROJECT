<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Ya Kotor Ya Cuci</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#004D40', // Deep Teal
                        'primary-hover': '#00382E', // Darker Deep Teal
                        'secondary': '#E0F2F1', // Light Teal background
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
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

<body class="font-sans bg-white">

    <div class="flex min-h-screen">

        <!-- Left Panel (Sticky with Slideshow) -->
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

        <!-- Right Panel (Scrollable) -->
        <div class="w-full lg:w-1/2 bg-white flex flex-col">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto my-auto text-center">

                <!-- Icon -->
                <div class="mb-6">
                    <i class="fas fa-envelope-open-text text-6xl text-primary"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-800">Verifikasi Email Anda</h1>
                <p class="text-gray-600 mt-4">
                    Kami telah mengirimkan tautan verifikasi ke alamat email Anda. Silakan cek kotak masuk (atau folder
                    spam) untuk melanjutkan.
                </p>

                @if (session('resent'))
                    <div class="bg-green-50 border-l-4 border-green-400 text-green-800 p-4 mt-6 text-left rounded-md"
                        role="alert">
                        <p class="font-semibold">Berhasil!</p>
                        <p class="text-sm">Tautan verifikasi baru telah dikirimkan ke alamat email Anda.</p>
                    </div>
                @endif


                <div class="mt-8 text-gray-600">
                    <p>Tidak menerima email?</p>
                    <form class="inline mt-2" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="font-semibold text-primary hover:underline p-0 m-0 bg-transparent border-none cursor-pointer hover:text-primary-hover transition">
                            Kirim ulang tautan verifikasi
                        </button>.
                    </form>
                </div>

                @auth
                    <div class="mt-10 w-full">
                        <form method="POST" action="{{ route('logout.post') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth

            </div>
        </div>
    </div>


    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
    </script>
</body>

</html>