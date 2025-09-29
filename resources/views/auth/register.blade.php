<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <!-- Custom style diletakkan setelah semua link agar override -->
        <style>
            .swiper-slide {
                background-size: cover !important;
                background-position: center !important;
            }
        </style>
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
            <div class="absolute inset-0 bg-black opacity-25"></div>
            <div class="absolute inset-0 p-12 flex flex-col justify-end">
                <div class="relative z-10">
                    <h2 class="text-4xl font-bold text-white leading-tight">Mulai Petualangan Bersih Anda.</h2>
                    <p class="text-white text-opacity-90 mt-2 text-lg">Daftar sekarang untuk mendapatkan layanan cuci terbaik kami.</p>
                </div>
            </div>
        </div>

        <!-- Right side with Registration Form -->
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
                        <label for="terms" class="ml-2 block text-sm text-gray-700">Saya setuju dengan <a href="#" id="terms-link"
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
    
    <!-- === MODAL SYARAT & KETENTUAN (TAMBAHAN BARU) === -->
    <div id="terms-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-full flex flex-col">
            <!-- Modal Header -->
            <div class="p-5 border-b">
                <h3 class="text-2xl font-semibold text-gray-800">Syarat & Ketentuan Layanan</h3>
            </div>
            
            <!-- Modal Body (dengan scroll) -->
            <div class="p-6 space-y-4 overflow-y-auto">
                <p class="text-gray-600">Mohon baca Syarat dan Ketentuan ("Ketentuan") ini dengan saksama sebelum menggunakan layanan "Ya Kotor Ya Cuci". Dengan mendaftar dan menggunakan layanan kami, Anda setuju untuk terikat oleh Ketentuan ini.</p>
                
                <div>
                    <h4 class="font-semibold text-gray-700">1. Pendaftaran Akun</h4>
                    <p class="text-gray-600 mt-1">Anda bertanggung jawab untuk memberikan informasi yang akurat dan lengkap saat membuat akun. Anda juga bertanggung jawab penuh untuk menjaga kerahasiaan kata sandi dan semua aktivitas yang terjadi di bawah akun Anda.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold text-gray-700">2. Layanan & Tanggung Jawab</h4>
                    <p class="text-gray-600 mt-1">Kami berkomitmen untuk memberikan layanan pencucian dengan kualitas terbaik. Namun, kami tidak bertanggung jawab atas kerusakan pada pakaian yang disebabkan oleh bahan yang tidak tahan cuci (luntur, susut) atau benda asing yang tertinggal di saku pakaian (pena, koin, dll.).</p>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-700">3. Barang Hilang atau Rusak</h4>
                    <p class="text-gray-600 mt-1">Keluhan mengenai barang yang hilang atau rusak harus dilaporkan dalam waktu 1x24 jam setelah pengiriman. Kompensasi, jika ada, tidak akan melebihi 5 kali biaya cuci dari barang yang bersangkutan dan akan melalui proses investigasi internal terlebih dahulu.</p>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-700">4. Pembayaran</h4>
                    <p class="text-gray-600 mt-1">Semua pembayaran harus diselesaikan sesuai dengan tagihan sebelum atau pada saat pakaian Anda diantar kembali. Kami menerima berbagai metode pembayaran yang tertera di aplikasi.</p>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-700">5. Privasi</h4>
                    <p class="text-gray-600 mt-1">Kami menghargai privasi Anda. Informasi pribadi yang Anda berikan hanya akan digunakan untuk keperluan penyediaan layanan dan tidak akan dibagikan kepada pihak ketiga tanpa persetujuan Anda.</p>
                </div>

                <p class="pt-2 text-sm text-gray-500">Dengan menekan tombol "Saya Setuju", Anda mengonfirmasi bahwa Anda telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan yang berlaku.</p>
            </div>
            
            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-5 border-t space-x-4">
                <button id="close-modal-btn" type="button" class="px-6 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none">
                    Tutup
                </button>
                <button id="agree-btn" type="button" class="px-6 py-2 text-white bg-primary rounded-lg hover:bg-blue-600 focus:outline-none">
                    Saya Setuju
                </button>
            </div>
        </div>
    </div>
    <!-- === AKHIR MODAL === -->

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

    <!-- === JAVASCRIPT MODAL (TAMBAHAN BARU) === -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const termsLink = document.getElementById('terms-link');
            const termsModal = document.getElementById('terms-modal');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const agreeBtn = document.getElementById('agree-btn');
            const termsCheckbox = document.getElementById('terms');

            // Fungsi untuk membuka modal
            termsLink.addEventListener('click', function (event) {
                event.preventDefault(); // Mencegah link berpindah halaman
                termsModal.classList.remove('hidden');
                termsModal.classList.add('flex', 'items-center', 'justify-center');
            });

            // Fungsi untuk menutup modal
            const closeModal = () => {
                termsModal.classList.remove('flex', 'items-center', 'justify-center');
                termsModal.classList.add('hidden');
            }

            closeModalBtn.addEventListener('click', closeModal);

            // Fungsi saat tombol "Saya Setuju" diklik
            agreeBtn.addEventListener('click', function () {
                termsCheckbox.checked = true; // Otomatis mencentang checkbox
                closeModal(); // Menutup modal
            });

            // Opsional: tutup modal jika klik di luar area konten modal
            termsModal.addEventListener('click', function(event) {
                if (event.target === termsModal) {
                    closeModal();
                }
            });
        });
    </script>
</body>
</html>