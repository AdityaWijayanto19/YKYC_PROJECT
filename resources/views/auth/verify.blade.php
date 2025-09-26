<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Ya Kotor Ya Cuci</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

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
                        'primary': '#3490dc',
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
                    <h2 class="text-4xl font-bold text-white leading-tight">Satu Langkah Lagi Menuju Akun Aktif.</h2>
                    <p class="text-white text-opacity-90 mt-2 text-lg">Kami perlu memastikan email ini benar-benar milik Anda.</p>
                </div>
            </div>
        </div>


        <!-- Right side with Verification Content -->
        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center h-screen overflow-y-auto">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Verifikasi Alamat Email Anda</h1>
                <p class="text-gray-600 mt-4">
                    Sebelum melanjutkan, mohon periksa kotak masuk email Anda untuk link verifikasi.
                </p>

                @if (session('resent'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg my-4 text-sm"
                    role="alert">
                    Link verifikasi baru telah berhasil dikirimkan ke alamat email Anda.
                </div>
                @endif


                <div class="mt-8 text-gray-600">
                    Jika Anda tidak menerima email,

                    <form class="inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="font-semibold text-primary hover:underline p-0 m-0 bg-transparent border-none cursor-pointer">
                            klik di sini untuk meminta lagi
                        </button>.
                    </form>
                </div>

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


    <script>
        // Initialize Swiper Carousel
        const swiper = new Swiper('.swiper', {
            loop: true,
            effect: 'fade', // Use fade effect for a smooth transition
            fadeEffect: {
                crossFade: true
            },
            autoplay: {
                delay: 4000, // Change image every 4 seconds
                disableOnInteraction: false,
            },
        });
    </script>
</body>

</html>