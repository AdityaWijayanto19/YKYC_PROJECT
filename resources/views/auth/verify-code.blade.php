<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Kode - Ya Kotor Ya Cuci</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
</head>

<body class="font-sans bg-white">

    <div class="flex min-h-screen">

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

        <div class="w-full lg:w-1/2 bg-white flex flex-col">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto my-auto text-center">

                <div class="mb-6">
                    <i class="fas fa-shield-halved text-6xl text-primary"></i>
                </div>

                <h1 class="text-3xl font-bold text-gray-800">Masukkan Kode Verifikasi</h1>
                
                <p class="text-gray-600 mt-4">
                    Kami telah mengirimkan kode 6 digit ke email Anda di 
                    <strong>{{ session('email', 'emailanda@contoh.com') }}</strong>.
                    Silakan cek kotak masuk Anda.
                </p>

                @if (session('error'))
                    <div class="bg-red-50 border-l-4 border-red-400 text-red-800 p-4 mt-6 text-left rounded-md" role="alert">
                        <p class="font-semibold">Gagal!</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                @endif
                
                <form class="mt-8 text-left" method="POST" action="{{ route('verification.verify') }}">
                    @csrf
                    
                    <input type="hidden" name="email" value="{{ session('email') }}">

                    <div>
                        <label for="verification_code" class="block text-sm font-medium text-gray-700">Kode 6 Digit</label>
                        <div class="mt-1">
                            <input id="verification_code" name="verification_code" type="text" 
                                   required 
                                   autofocus
                                   maxlength="6"
                                   pattern="[0-9]*" 
                                   inputmode="numeric"
                                   class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary text-base text-center tracking-[1em]">
                        </div>
                        @error('verification_code')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Verifikasi Akun
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>