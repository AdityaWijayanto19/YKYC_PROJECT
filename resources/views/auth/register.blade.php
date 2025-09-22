<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun - Ya Kotor Ya Cuci</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3490dc', // Warna biru utama Anda
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-sans">

    <div class="min-h-screen md:flex">
        
        <div class="hidden md:block md:w-1/2 relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1473580044384-7ba9967e16a0?q=80&w=2070&auto=format&fit=crop');">
            <div class="p-12 flex flex-col justify-between h-full">
                <div class="absolute inset-0 bg-black opacity-20"></div>
                
                <div class="relative z-10">
                    <a href="/" class="text-3xl font-bold text-white tracking-wider">YKYc</a>
                </div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-bold text-white">Capturing Moments, Creating Memories.</h2>
                    <p class="text-white text-opacity-90 mt-2">Daftar sekarang untuk mendapatkan layanan terbaik kami.</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center">
            <div class="p-8 md:p-12 lg:p-16 w-full max-w-md mx-auto">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Buat Akun Baru</h1>
                <p class="text-gray-600 mt-2">
                    Sudah punya akun?
                    <a href="/login" class="font-semibold text-primary hover:underline">
                        Login di sini
                    </a>
                </p>

                <form method="POST" action="/register" class="mt-8 space-y-6">
                    @csrf

                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="w-full sm:w-1/2">
                            <label for="first_name" class="sr-only">Nama Depan</label>
                            <input id="first_name" name="first_name" type="text" required class="block w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Nama Depan">
                        </div>
                        <div class="w-full sm:w-1/2">
                            <label for="last_name" class="sr-only">Nama Belakang</label>
                            <input id="last_name" name="last_name" type="text" required class="block w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Nama Belakang">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="sr-only">Email</label>
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Alamat Email">
                    </div>

                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required class="block w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Buat password">
                    </div>
                    
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">Saya setuju dengan <a href="#" class="font-medium text-primary hover:underline">Syarat & Ketentuan</a></label>
                    </div>

                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            Buat Akun
                        </button>
                    </div>
                </form>

                <div class="my-6 flex items-center">
                    <hr class="flex-grow border-gray-300">
                    <span class="mx-4 text-sm font-medium text-gray-500">Atau daftar dengan</span>
                    <hr class="flex-grow border-gray-300">
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="w-full flex items-center justify-center gap-2 py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"></path><path fill="#FF3D00" d="M6.306 14.691l6.057 4.844C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691z"></path><path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238C29.211 35.091 26.715 36 24 36c-5.223 0-9.657-3.657-11.303-8H6.697v5.309C9.72 39.923 16.225 44 24 44z"></path><path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303c-.792 2.237-2.231 4.166-4.087 5.571l6.19 5.238C42.022 35.798 44 30.291 44 24c0-1.341-.138-2.65-.389-3.917z"></path></svg>
                        <span class="text-sm font-medium text-gray-700">Google</span>
                    </button>
                    <button class="w-full flex items-center justify-center gap-2 py-3 px-4 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516s1.52.087 2.475-1.258.762-2.391.728-2.43m3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422s1.675-2.789 1.698-2.854-.597-.79-1.254-1.157a3.7 3.7 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56s.625 1.924 1.273 2.796c.576.984 1.34 1.667 1.659 1.899s1.219.386 1.843.067c.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758q.52-1.185.473-1.282"></path></svg>
                        <span class="text-sm font-medium text-gray-700">Apple</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

</body>
</html>