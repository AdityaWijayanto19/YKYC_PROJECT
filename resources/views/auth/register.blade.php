<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun - Ya Kotor Ya Cuci</title>

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

<body class="font-sans bg-white">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex w-1/2 bg-secondary items-center justify-center p-12 relative h-screen sticky top-0">
            <div class="relative w-full max-w-lg text-center">
                <div class="animate-float">
                    <img src="{{ asset('images/vector-login.svg') }}" alt="Ilustrasi vektor sepatu bersih"
                        class="w-96 h-auto mx-auto">
                </div>
                <div class="mt-8 relative">
                    <h1 class="text-3xl font-bold text-primary">Mulai Petualangan Bersih Anda.</h1>
                    <p class="text-gray-600 mt-2 max-w-md mx-auto">Satu langkah lagi menuju sepatu yang selalu tampak
                        baru.</p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 bg-white flex flex-col">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto my-auto">

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

                <h2 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h2>
                <p class="text-gray-600 mt-2">
                    Sudah punya akun?
                    <a href="/login" class="font-semibold text-primary hover:underline">
                        Login di sini
                    </a>
                </p>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mt-6 rounded-md" role="alert">
                        <p class="font-bold">Oops! Ada yang salah:</p>
                        <ul class="list-disc list-inside mt-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.post') }}" class="mt-8 space-y-5">
                    @csrf

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-user text-gray-400"></i>
                        </span>
                        <input id="name" name="name" type="text" required value="{{ old('name') }}"
                            class="block w-full pl-12 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Nama Lengkap Anda">
                    </div>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </span>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="block w-full pl-12 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Alamat Email">
                    </div>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-lock text-gray-400"></i>
                        </span>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="block w-full pl-12 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Buat Password">
                    </div>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-check-circle text-gray-400"></i>
                        </span>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="block w-full pl-12 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition"
                            placeholder="Konfirmasi Password">
                    </div>

                    <div class="flex items-center pt-1">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms" class="ml-3 block text-sm text-gray-700">Saya setuju dengan <a href="#"
                                id="terms-link" class="font-medium text-primary hover:underline">Syarat &
                                Ketentuan</a></label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Buat Akun
                        </button>
                    </div>
                </form>

                <div class="my-6 flex items-center">
                    <hr class="flex-grow border-gray-200">
                    <span class="mx-4 text-sm font-medium text-gray-500">atau</span>
                    <hr class="flex-grow border-gray-200">
                </div>

                <!-- Google Login Button -->
                <div>
                    <a href="{{ route('google.redirect') }}"
                        class="w-full flex items-center justify-center gap-3 py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors group">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo"
                            class="h-5 w-5">
                        <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Daftar dengan
                            Google</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div id="terms-modal" class="fixed inset-0 bg-black bg-opacity-60 z-50 hidden p-4 backdrop-blur-sm">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-full flex flex-col m-auto">
            <div class="p-5 border-b flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-800">Syarat & Ketentuan Layanan</h3>
                <button id="close-modal-x" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="p-6 space-y-4 overflow-y-auto">
                <p class="text-gray-600">Mohon baca Syarat dan Ketentuan ("Ketentuan") ini dengan saksama sebelum
                    menggunakan layanan "Ya Kotor Ya Cuci". Dengan mendaftar dan menggunakan layanan kami, Anda
                    setuju
                    untuk terikat oleh Ketentuan ini.</p>
                <div>
                    <h4 class="font-semibold text-gray-700">1. Pendaftaran Akun</h4>
                    <p class="text-gray-600 mt-1">Anda bertanggung jawab untuk memberikan informasi yang akurat dan
                        lengkap saat membuat akun. Anda juga bertanggung jawab penuh untuk menjaga kerahasiaan kata
                        sandi dan semua aktivitas yang terjadi di bawah akun Anda.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700">2. Privasi</h4>
                    <p class="text-gray-600 mt-1">Kami menghargai privasi Anda. Informasi pribadi yang Anda berikan
                        hanya akan digunakan untuk keperluan penyediaan layanan dan tidak akan dibagikan kepada
                        pihak
                        ketiga tanpa persetujuan Anda.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700">3. Layanan & Tanggung Jawab</h4>
                    <p class="text-gray-600 mt-1">Kami berkomitmen untuk memberikan layanan pencucian dengan
                        kualitas
                        terbaik. Namun, kami tidak bertanggung jawab atas kerusakan pada sepatu yang disebabkan oleh
                        bahan yang sudah rapuh atau aus karena usia pemakaian.</p>
                </div>
            </div>

            <div class="flex items-center justify-end p-5 border-t space-x-4 bg-gray-50 rounded-b-lg">
                <button id="close-modal-btn" type="button"
                    class="px-6 py-2 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none transition">
                    Tutup
                </button>
                <button id="agree-btn" type="button"
                    class="px-6 py-2 text-white bg-primary rounded-lg hover:bg-primary-hover focus:outline-none transition">
                    Saya Setuju
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const termsLink = document.getElementById('terms-link');
            const termsModal = document.getElementById('terms-modal');
            const closeModalX = document.getElementById('close-modal-x');
            const closeModalBtn = document.getElementById('close-modal-btn');
            const agreeBtn = document.getElementById('agree-btn');
            const termsCheckbox = document.getElementById('terms');

            const openModal = () => {
                termsModal.classList.remove('hidden');
                termsModal.classList.add('flex');
            };
            const closeModal = () => {
                termsModal.classList.add('hidden');
                termsModal.classList.remove('flex');
            };

            termsLink.addEventListener('click', (e) => {
                e.preventDefault();
                openModal();
            });

            closeModalX.addEventListener('click', closeModal);
            closeModalBtn.addEventListener('click', closeModal);

            agreeBtn.addEventListener('click', () => {
                termsCheckbox.checked = true;
                closeModal();
            });

            termsModal.addEventListener('click', (e) => {
                if (e.target === termsModal) {
                    closeModal();
                }
            });
        });
    </script>
</body>

</html>