<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ya Kotor Ya Cuci</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex items-center justify-center min-h-screen px-4 py-12">
        
        <div class="w-full max-w-md">
            
            <div class="text-center mb-8">
                <a href="/" class="text-3xl font-bold text-primary">YKYc</a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mt-4">Buat Akun Baru</h1>
                <p class="text-gray-500 mt-2">Daftar sekarang untuk mulai menggunakan layanan kami.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg w-full">
                
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <input 
                            id="name" 
                            name="name" 
                            type="text" 
                            autocomplete="name" 
                            required 
                            autofocus
                            value="{{ old('name') }}"
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror"
                            placeholder="Nama Lengkap Anda"
                        >
                        @error('name')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat Email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            value="{{ old('email') }}"
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="contoh@email.com"
                        >
                        @error('email')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor HP
                        </label>
                        <input 
                            id="phone_number" 
                            name="phone_number" 
                            type="tel" 
                            autocomplete="tel"
                            required
                            value="{{ old('phone_number') }}"
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('phone_number') border-red-500 @enderror"
                            placeholder="081234567890"
                        >
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="new-password" 
                            required
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror"
                            placeholder="Minimal 8 karakter"
                        >
                        @error('password')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            autocomplete="new-password" 
                            required
                            class="block w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Ketik ulang password Anda"
                        >
                    </div>

                    <div>
                        <button 
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors"
                        >
                            Daftar
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
                        Login di sini
                    </a>
                </p>

            </div>
        </div>
    </div>

</body>
</html>