<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ya Kotor Ya Cuci (YKYc) - Jasa Laundry Sepatu Profesional</title>
    <meta name="description" content="YKYc adalah jasa laundry sepatu portabel dengan konsep gerobak. Cepat, bersih, dan dekat dengan Anda.">

    <!-- TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#3490dc', // Biru muda
                    'secondary': '#f8fafc', // Putih keabuan
                },
                fontFamily: {
                    'sans': ['Inter', 'sans-serif'],
                }
            }
        }
    }
    </script>
    
    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Leaflet.js for Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <style>
        /* Simple Fade-in Animation Class */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

</head>
<body class="bg-secondary font-sans text-gray-800">

    <!-- =========== Header & Navbar =========== -->
    <header class="bg-white/80 backdrop-blur-lg shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <a href="#home" class="">
                    <img class="h-10" src="/images/favicon-dark.svg" alt="">
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="#home" class="text-gray-600 hover:text-primary transition">Home</a>
                    <a href="#layanan" class="text-gray-600 hover:text-primary transition">Layanan</a>
                    <a href="#lokasi" class="text-gray-600 hover:text-primary transition">Lokasi</a>
                    <a href="#galeri" class="text-gray-600 hover:text-primary transition">Galeri</a>
                    <a href="#faq" class="text-gray-600 hover:text-primary transition">FAQ</a>
                    <a href="#kontak" class="text-gray-600 hover:text-primary transition">Kontak</a>
                </div>
                
                <div class="hidden md:flex items-center space-x-2">
                    <a href="/login" class="px-4 py-2 text-primary border border-primary rounded-md hover:bg-primary hover:text-white transition">Login</a>
                    <a href="/register" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-600 transition">Register</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-800 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4">
                <a href="#home" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Home</a>
                <a href="#layanan" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Layanan</a>
                <a href="#lokasi" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Lokasi</a>
                <a href="#galeri" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Galeri</a>
                <a href="#faq" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">FAQ</a>
                <a href="#kontak" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Kontak</a>
                <div class="mt-4 pt-4 border-t">
                    <a href="/login" class="block w-full text-center px-4 py-2 text-primary border border-primary rounded-md hover:bg-primary hover:text-white transition mb-2">Login</a>
                    <a href="/register" class="block w-full text-center px-4 py-2 bg-primary text-white rounded-md hover:bg-blue-600 transition">Register</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- =========== Home Section =========== -->
        <section id="home" class="bg-white">
            <div class="container mx-auto px-6 py-20 md:py-32 text-center">
                <div class="max-w-3xl mx-auto">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-4 animate-fade-in">Ya Kotor Ya Cuci</h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-8">Solusi laundry sepatu cepat dan praktis langsung dari gerobak portabel kami. Sepatu bersih kinclong dalam sekejap!</p>
                    <a href="#kontak" class="bg-primary text-white font-bold py-3 px-8 rounded-full hover:bg-blue-600 transition text-lg">Booking Sekarang</a>
                </div>
                
                <!-- Keunggulan -->
                <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="fade-in">
                        <div class="bg-blue-100 inline-block p-4 rounded-full mb-4">
                            <!-- Heroicon: bolt -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Cepat & Praktis</h3>
                        <p class="text-gray-500">Layanan ekspres langsung di tempat, tak perlu menunggu berhari-hari.</p>
                    </div>
                    <div class="fade-in">
                        <div class="bg-blue-100 inline-block p-4 rounded-full mb-4">
                             <!-- Heroicon: sparkles -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.293 2.293a1 1 0 010 1.414L10 12l-2.293 2.293a1 1 0 01-1.414 0L4 12l2.293-2.293a1 1 0 011.414 0L10 12z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Hasil Maksimal</h3>
                        <p class="text-gray-500">Menggunakan pembersih premium yang aman untuk semua bahan sepatu.</p>
                    </div>
                    <div class="fade-in">
                        <div class="bg-blue-100 inline-block p-4 rounded-full mb-4">
                             <!-- Heroicon: currency-dollar -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01" /></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Harga Terjangkau</h3>
                        <p class="text-gray-500">Kualitas premium dengan harga yang ramah di kantong.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========== Layanan & Harga =========== -->
        <section id="layanan" class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Layanan & Harga Kami</h2>
                    <p class="text-lg text-gray-600 mt-2">Pilih paket yang paling sesuai dengan kebutuhan sepatumu.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition duration-300 fade-in">
                        <h3 class="text-2xl font-bold text-primary mb-4">Quick Clean</h3>
                        <p class="text-gray-600 mb-6">Pembersihan cepat pada bagian upper dan midsole. Cocok untuk noda ringan dan pemakaian harian.</p>
                        <div class="text-3xl font-bold text-gray-900">Rp 25.000</div>
                        <p class="text-gray-500">/pasang</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition duration-300 fade-in">
                        <h3 class="text-2xl font-bold text-primary mb-4">Deep Clean</h3>
                        <p class="text-gray-600 mb-6">Pembersihan menyeluruh meliputi upper, midsole, outsole, tali, dan insole. Menghilangkan noda membandel.</p>
                        <div class="text-3xl font-bold text-gray-900">Rp 45.000</div>
                        <p class="text-gray-500">/pasang</p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white rounded-lg shadow-lg p-8 transform hover:-translate-y-2 transition duration-300 fade-in">
                        <h3 class="text-2xl font-bold text-primary mb-4">Unyellowing</h3>
                        <p class="text-gray-600 mb-6">Proses khusus untuk mengembalikan warna putih pada midsole yang sudah menguning karena oksidasi.</p>
                        <div class="text-3xl font-bold text-gray-900">Rp 35.000</div>
                        <p class="text-gray-500">/pasang</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========== Lokasi Gerobak Aktif =========== -->
        <section id="lokasi" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Temukan Gerobak Kami</h2>
                    <p class="text-lg text-gray-600 mt-2">Cek lokasi gerobak YKYc yang aktif hari ini!</p>
                </div>
                <div id="map" class="h-[500px] rounded-lg shadow-lg z-10 fade-in"></div>
            </div>
        </section>

        <!-- =========== Galeri & Testimoni =========== -->
        <section id="galeri" class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Hasil Kerja Kami</h2>
                    <p class="text-lg text-gray-600 mt-2">Sebelum dan sesudah, lihat perbedaannya!</p>
                </div>
                <!-- Galeri -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-20">
                    <div class="fade-in"><img src="https://via.placeholder.com/400x300.png/9ca3af/ffffff?text=Before+1" alt="Sepatu kotor" class="rounded-lg shadow-md"></div>
                    <div class="fade-in"><img src="https://via.placeholder.com/400x300.png/3490dc/ffffff?text=After+1" alt="Sepatu bersih" class="rounded-lg shadow-md"></div>
                    <div class="fade-in"><img src="https://via.placeholder.com/400x300.png/9ca3af/ffffff?text=Before+2" alt="Sepatu kotor" class="rounded-lg shadow-md"></div>
                    <div class="fade-in"><img src="https://via.placeholder.com/400x300.png/3490dc/ffffff?text=After+2" alt="Sepatu bersih" class="rounded-lg shadow-md"></div>
                    <div class="fade-in"><img src="https://via.placeholder.com/400x300.png/9ca3af/ffffff?text=Before+3" alt="Sepatu kotor" class="rounded-lg shadow-md"></div>
                    <div class="fade-in"><img src="https://via.placeholder.com/400x300.png/3490dc/ffffff?text=After+3" alt="Sepatu bersih" class="rounded-lg shadow-md"></div>
                </div>
                
                <!-- Testimoni -->
                 <div class="text-center mb-12">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900">Apa Kata Mereka?</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-lg fade-in">
                        <p class="text-gray-600 italic">"Gila, cepet banget bersihnya! Gerobaknya pas banget lagi deket kantor. Recommended!"</p>
                        <p class="text-right font-bold text-primary mt-4">- Budi, Karyawan Swasta</p>
                    </div>
                     <div class="bg-white p-6 rounded-lg shadow-lg fade-in">
                        <p class="text-gray-600 italic">"Sneakers putihku yang udah kusam jadi kayak baru lagi. Harganya juga oke banget."</p>
                        <p class="text-right font-bold text-primary mt-4">- Citra, Mahasiswi</p>
                    </div>
                     <div class="bg-white p-6 rounded-lg shadow-lg fade-in">
                        <p class="text-gray-600 italic">"Praktis, nggak perlu nunggu lama. Habis lari pagi, mampir bentar, sepatu langsung bersih."</p>
                        <p class="text-right font-bold text-primary mt-4">- Anton, Komunitas Lari</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========== FAQ =========== -->
        <section id="faq" class="py-20 bg-white">
            <div class="container mx-auto px-6 max-w-3xl">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Pertanyaan Umum (FAQ)</h2>
                </div>
                <div class="space-y-4">
                    <!-- FAQ Item 1 -->
                    <div class="bg-gray-50 rounded-lg fade-in">
                        <button class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold">
                            <span>Berapa lama proses pengerjaannya?</span>
                            <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="faq-content hidden p-5 pt-0">
                            <p class="text-gray-600">Untuk Quick Clean, prosesnya sekitar 15-20 menit. Sedangkan Deep Clean bisa memakan waktu 30-45 menit tergantung tingkat kotoran sepatu Anda.</p>
                        </div>
                    </div>
                    <!-- FAQ Item 2 -->
                    <div class="bg-gray-50 rounded-lg fade-in">
                        <button class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold">
                            <span>Apakah bahan pembersihnya aman?</span>
                            <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="faq-content hidden p-5 pt-0">
                            <p class="text-gray-600">Tentu saja! Kami menggunakan cairan pembersih premium yang diformulasikan khusus untuk bahan sepatu (kanvas, suede, kulit, dll) sehingga aman dan tidak merusak warna atau material.</p>
                        </div>
                    </div>
                     <!-- FAQ Item 3 -->
                    <div class="bg-gray-50 rounded-lg fade-in">
                        <button class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold">
                            <span>Bagaimana cara menemukan lokasi gerobak?</span>
                            <svg class="w-6 h-6 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="faq-content hidden p-5 pt-0">
                            <p class="text-gray-600">Anda bisa melihat lokasi gerobak kami yang sedang aktif secara real-time pada peta di bagian "Lokasi Gerobak Aktif" di atas. Lokasi kami perbarui setiap hari.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========== Kontak & Booking Cepat =========== -->
        <section id="kontak" class="py-20">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="fade-in">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                        <p class="text-lg text-gray-600 mb-8">Punya pertanyaan atau ingin booking layanan dari rumah? Isi form di samping dan tim kami akan segera menghubungi Anda.</p>
                        <div class="space-y-4">
                            <p class="flex items-center text-gray-700"><svg class="w-5 h-5 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +62 812-3456-7890</p>
                            <p class="flex items-center text-gray-700"><svg class="w-5 h-5 mr-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> hello@ykyc.com</p>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-lg fade-in">
                        <h3 class="text-2xl font-bold mb-6 text-center">Booking Cepat</h3>
                        <form action="#" method="POST">
                            <div class="mb-4">
                                <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Nama Anda" required>
                            </div>
                            <div class="mb-4">
                                <label for="hp" class="block text-gray-700 font-semibold mb-2">Nomor HP (WhatsApp)</label>
                                <input type="tel" id="hp" name="hp" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="08123456xxxx" required>
                            </div>
                            <div class="mb-4">
                                <label for="layanan-booking" class="block text-gray-700 font-semibold mb-2">Pilih Layanan</label>
                                <select id="layanan-booking" name="layanan" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option>Quick Clean</option>
                                    <option>Deep Clean</option>
                                    <option>Unyellowing</option>
                                </select>
                            </div>
                             <div class="mb-6">
                                <label for="pesan" class="block text-gray-700 font-semibold mb-2">Pesan (Opsional)</label>
                                <textarea id="pesan" name="pesan" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Contoh: Sepatu saya bahan suede."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition">Kirim Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- =========== Footer =========== -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <h3 class="text-xl font-bold mb-4">Ya Kotor Ya Cuci (YKYc)</h3>
                    <p class="text-gray-400">Jasa laundry sepatu portabel. Cepat, bersih, dan praktis.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Navigasi</h3>
                    <ul class="space-y-2">
                        <li><a href="#layanan" class="text-gray-400 hover:text-white">Layanan</a></li>
                        <li><a href="#lokasi" class="text-gray-400 hover:text-white">Lokasi</a></li>
                        <li><a href="#faq" class="text-gray-400 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Ikuti Kami</h3>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"></path></svg></a>
                        <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2.163c3.204,0,3.584,0.012,4.85,0.07c3.252,0.148,4.771,1.691,4.919,4.919c0.058,1.265,0.069,1.645,0.069,4.85s-0.012,3.584-0.07,4.85c-0.148,3.227-1.669,4.771-4.919,4.919c-1.266,0.058-1.644,0.07-4.85,0.07s-3.584-0.012-4.85-0.07c-3.252-0.148-4.771-1.691-4.919-4.919c-0.058-1.265-0.07-1.645-0.07-4.85s0.012-3.584,0.07-4.85c0.148-3.227,1.669-4.771,4.919-4.919C8.416,2.175,8.796,2.163,12,2.163 M12,0C8.741,0,8.333,0.014,7.053,0.072C2.695,0.272,0.273,2.69,0.073,7.052C0.014,8.333,0,8.741,0,12c0,3.259,0.014,3.668,0.072,4.948c0.2,4.358,2.618,6.78,6.98,6.98c1.279,0.058,1.688,0.072,4.949,0.072c3.259,0,3.668-0.014,4.948-0.072c4.354-0.2,6.782-2.618,6.979-6.98c0.058-1.279,0.072-1.688,0.072-4.948c0-3.259-0.014-3.668-0.072-4.948C23.728,2.695,21.302,0.274,16.948,0.072C15.668,0.014,15.259,0,12,0L12,0z M12,5.838c-3.403,0-6.162,2.759-6.162,6.162s2.759,6.162,6.162,6.162s6.162-2.759,6.162-6.162S15.403,5.838,12,5.838z M12,16c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S14.209,16,12,16z M16.965,5.595c-0.623,0-1.128,0.504-1.128,1.127s0.504,1.128,1.128,1.128c0.623,0,1.128-0.504,1.128-1.128S17.588,5.595,16.965,5.595z"></path></svg></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-500">
                &copy; {{ date('Y') }} Ya Kotor Ya Cuci. All Rights Reserved.
            </div>
        </div>
    </footer>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // ========== Mobile Menu Toggle ==========
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });


        // ========== FAQ Accordion ==========
        const faqToggles = document.querySelectorAll('.faq-toggle');
        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const content = toggle.nextElementSibling;
                const icon = toggle.querySelector('svg');

                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });


        // ========== Leaflet.js Map Initialization ==========
        // Koordinat dummy (misal: Jakarta)
        const map = L.map('map').setView([-6.2088, 106.8456], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Dummy markers
        const locations = [
            { lat: -6.2297, lng: 106.8093, name: 'Gerobak Senayan Park' },
            { lat: -6.1751, lng: 106.8650, name: 'Gerobak Stasiun Gambir' },
            { lat: -6.2415, lng: 106.8242, name: 'Gerobak Blok M Square' }
        ];

        locations.forEach(loc => {
            L.marker([loc.lat, loc.lng]).addTo(map)
                .bindPopup(`<b>${loc.name}</b><br>Aktif sekarang!`)
                .openPopup();
        });


        // ========== Scroll Animation (Fade-in) ==========
        const fadeInElements = document.querySelectorAll('.fade-in');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        fadeInElements.forEach(el => {
            observer.observe(el);
        });

    });
    </script>

</body>
</html>