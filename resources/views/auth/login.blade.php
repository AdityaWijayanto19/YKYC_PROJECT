<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ya Kotor Ya Cuci</title>

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

    <div class="flex items-center justify-center min-h-screen px-4">
        
        <div class="w-full max-w-md">
            
            <div class="text-center mb-8">
                <a href="/" class="text-3xl font-bold text-primary">YKYc</a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mt-4">Login ke Akun Anda</h1>
                <p class="text-gray-500 mt-2">Selamat datang kembali! Silakan masukkan detail Anda.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg w-full">
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    @error('email')
                        @if ($message === 'These credentials do not match our records.')
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                            <span class="block sm:inline">Email atau password yang Anda masukkan salah.</span>
                        </div>
                        @endif
                    @enderror

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
                            @if ($message !== 'These credentials do not match our records.')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @endif
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-sm font-semibold text-gray-700">
                                Password
                            </label>
                            <a href="{{--{{ route('password.request') }}--}}" class="text-sm font-medium text-primary hover:underline">
                                Lupa password?
                            </a>
                        </div>
                        <div class="mt-2">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                autocomplete="current-password" 
                                required
                                class="block w-full px-4 py-3 rounded-lg border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror"
                                placeholder="••••••••"
                            >
                            @error('password')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button 
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors"
                        >
                            Login
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-primary hover:underline">
                        Register di sini
                    </a>
                </p>

            </div>
        </div>
    </div>

</body>
</html>