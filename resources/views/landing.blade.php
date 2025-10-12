<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ya Kotor Ya Cuci (YKYc) - Jasa Laundry Sepatu Profesional</title>
    <meta name="description"
        content="YKYc adalah jasa laundry sepatu portabel dengan konsep gerobak. Cepat, bersih, dan dekat dengan Anda.">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
            background-color: #333;
        }

        .text-cyan-custom {
            color: #00B2EE;
        }

        .bg-cyan-custom {
            background-color: #00B2EE;
        }

        .bg-cyan-custom:hover {
            background-color: #009BD6;
        }

        .border-cyan-custom {
            border-color: #00B2EE;
        }

        .nav-glassmorphism {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .service-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .hero-slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .hero-slideshow-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transform: scale(1.15);
            transition: opacity 2s ease-in-out;
            animation: ken-burns 20s infinite;
        }

        .hero-slideshow-image.active {
            opacity: 1;
        }

        @keyframes ken-burns {
            0% {
                transform: scale(1.15) translate(0, 0);
            }

            50% {
                transform: scale(1.05) translate(2%, -2%);
            }

            100% {
                transform: scale(1.15) translate(0, 0);
            }
        }

        .faq-toggle i {
            transition: transform 0.3s ease-in-out;
        }

        .faq-toggle.open i {
            transform: rotate(180deg);
        }

        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }

        .faq-content.open {
            max-height: 200px;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* === GAYA CAROUSEL === */
        #about-gallery-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            scrollbar-width: none;
            -ms-overflow-style: none;
            user-select: none;
        }

        #about-gallery-wrapper::-webkit-scrollbar {
            display: none;
        }

        #about-gallery {
            display: flex;
            width: fit-content;
        }

        .gallery-card {
            width: 320px;
            flex-shrink: 0;
            margin: 0 0.75rem;
            border-radius: 1rem;
            overflow: hidden;
            height: 280px;
            transition: width 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .gallery-card-image-wrapper {
            flex-shrink: 0;
            height: 100%;
            border-radius: 0.5rem;
            overflow: hidden;
            width: 100%;
            transition: width 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .gallery-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }

        .gallery-card-content {
            width: 0;
            opacity: 0;
            overflow: hidden;
            transition: width 0.5s cubic-bezier(0.23, 1, 0.32, 1), opacity 0.4s ease 0.2s;
        }

        .gallery-card:hover {
            width: 500px;
        }

        .gallery-card:hover .gallery-card-image-wrapper {
            width: 40%;
        }

        .gallery-card:hover .gallery-card-content {
            width: 60%;
            opacity: 1;
        }

        /* === STYLE MODAL/POPUP === */
        #modal-container {
            transition: opacity 0.3s ease-in-out;
        }

        #modal-box {
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    <header id="main-header"
        class="fixed top-0 left-0 right-0 z-50 text-white transition-all duration-300 nav-glassmorphism">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#home"><img id="header-logo" class="h-10 brightness-0 invert transition-all duration-300"
                        src="/images/favicon-dark.svg" alt="YKYc Logo"></a>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#home" class="hover:text-cyan-custom transition">Home</a>
                    <a href="#aboutus" class="hover:text-cyan-custom transition">About Us</a>
                    <a href="#layanan" class="hover:text-cyan-custom transition">Layanan</a>
                    <a href="#faq" class="hover:text-cyan-custom transition">FAQ</a>
                    <a href="#kontak" class="hover:text-cyan-custom transition">Kontak</a>
                    <div class="flex items-center space-x-2 pl-4">
                        <a href="/login"
                            class="px-5 py-2 border rounded-full hover:bg-white hover:text-black transition text-sm font-semibold">Login</a>
                        <a href="/register"
                            class="px-5 py-2 bg-cyan-custom text-white rounded-full hover:bg-opacity-80 transition text-sm font-semibold">Register</a>
                    </div>
                </div>
                <div class="md:hidden"><button id="mobile-menu-button" class="focus:outline-none"><i
                            class="fas fa-bars text-2xl"></i></button></div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden mt-4 bg-black bg-opacity-80 backdrop-blur-sm rounded-lg p-4">
                <a href="#home" class="block py-2 px-3 text-white hover:bg-gray-700 rounded">Home</a><a href="#layanan"
                    class="block py-2 px-3 text-white hover:bg-gray-700 rounded">Layanan</a><a href="#faq"
                    class="block py-2 px-3 text-white hover:bg-gray-700 rounded">FAQ</a><a href="#kontak"
                    class="block py-2 px-3 text-white hover:bg-gray-700 rounded">Kontak</a>
                <div class="mt-4 pt-4 border-t border-gray-600"><a href="/login"
                        class="block w-full text-center px-4 py-2 text-cyan-custom border border-cyan-custom rounded-md hover:bg-cyan-custom hover:text-white transition mb-2">Login</a><a
                        href="/register"
                        class="block w-full text-center px-4 py-2 bg-cyan-custom text-white rounded-md hover:bg-opacity-80 transition">Register</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="home" class="hero-section h-screen flex items-center justify-center text-white text-center">
            <div class="hero-slideshow">
                <div class="hero-slideshow-image"
                    style="background-image: url('https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070&auto=format&fit=crop');">
                </div>
                <div class="hero-slideshow-image"
                    style="background-image: url('https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1974&auto=format&fit=crop');">
                </div>
            </div>
            <div class="bg-black bg-opacity-50 inset-0 absolute z-10"></div>
            <div class="relative z-20 px-4">
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">Ya Kotor Ya Cuci</h1>
                <p class="mt-4 text-xl md:text-2xl font-semibold max-w-3xl mx-auto">Solusi laundry sepatu cepat dan
                    praktis langsung dari gerobak portabel kami. Sepatu bersih kinclong dalam sekejap!</p>
                <a href="#layanan"
                    class="mt-8 inline-block bg-cyan-custom text-white font-bold py-3 px-10 rounded-full transition">Lihat
                    Layanan Kami</a>
            </div>
        </section>

        <section id="aboutus" class="py-20 bg-white">
            <div class="container mx-auto">
                <div class="relative rounded-2xl bg-white overflow-hidden">
                    <div class="absolute inset-0 bg-cover bg-center z-0"
                        style="background-image: url('https://i.imgur.com/u5ppt3s.png'); opacity: 0.7;"></div>
                    <div class="relative z-10 p-8 md:p-12">
                        <div class="flex justify-between items-center mb-12 px-4 flex-col md:flex-row">
                            <div class="text-center md:text-left max-w-2xl mb-6 md:mb-0">
                                <h3 class="text-3xl font-bold text-gray-800">Kenali Inovasi Kami Lebih Dekat</h3>
                                <p class="mt-2 text-gray-600">Setiap detail dari layanan kami dirancang untuk memberikan
                                    yang terbaik bagi sepatu dan lingkungan Anda.</p>
                            </div>
                        </div>

                        <div id="about-gallery-wrapper">
                            <div id="about-gallery">
                                <!-- Galeri Kartu -->
                                <div class="gallery-card">
                                    <div
                                        class="bg-black/10 backdrop-blur-lg border border-white/20 flex items-center h-full p-4">
                                        <div class="gallery-card-image-wrapper">
                                            <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1974&auto=format&fit=crop"
                                                alt="Gerobak Listrik YKYC" class="gallery-card-image">
                                        </div>
                                        <div class="gallery-card-content pl-5 text-blue-400">
                                            <h4 class="font-semibold text-lg">Gerobak Listrik YKYC</h4>
                                            <p class="text-sm text-blue-400 mt-2">Inovasi ramah lingkungan untuk cuci
                                                sepatu praktis, cepat, dan peduli bumi.</p>
                                            <button
                                                class="gallery-modal-trigger mt-4 w-10 h-10 rounded-full border border-blue-400/40 flex items-center justify-center hover:bg-blue-400/20 transition"
                                                data-image="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1974&auto=format&fit=crop"
                                                data-title="Gerobak Listrik Ramah Lingkungan"
                                                data-description="Gerobak kami ditenagai sepenuhnya oleh listrik, mengurangi emisi karbon dan polusi suara. Desainnya yang ringkas memungkinkan kami menjangkau Anda di mana saja, membawa layanan cuci sepatu profesional langsung ke depan pintu Anda tanpa merusak lingkungan.">
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="gallery-card">
                                    <div
                                        class="bg-black/10 backdrop-blur-lg border border-white/20 flex items-center h-full p-4">
                                        <div class="gallery-card-image-wrapper">
                                            <img src="https://i.pinimg.com/1200x/a3/e1/ce/a3e1ceb20b3cb96d1317472e1aa8235a.jpg"
                                                alt="Foam Cuci Sepatu" class="gallery-card-image">
                                        </div>
                                        <div class="gallery-card-content pl-5 text-blue-400">
                                            <h4 class="font-semibold text-lg">Pembersih Premium</h4>
                                            <p class="text-sm text-blue-400 mt-2">Bahan terbaik yang aman untuk semua
                                                jenis sepatu kesayangan Anda.</p>
                                            <button
                                                class="gallery-modal-trigger mt-4 w-10 h-10 rounded-full border border-blue-400/40 flex items-center justify-center hover:bg-blue-400/20 transition"
                                                data-image="https://i.pinimg.com/1200x/a3/e1/ce/a3e1ceb20b3cb96d1317472e1aa8235a.jpg"
                                                data-title="Cairan Pembersih Organik & Efektif"
                                                data-description="Kami hanya menggunakan cairan pembersih premium yang terbuat dari bahan-bahan organik dan biodegradable. Formula ini dirancang khusus untuk mengangkat noda membandel tanpa merusak warna atau tekstur sepatu.">
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="gallery-card">
                                    <div
                                        class="bg-black/10 backdrop-blur-lg border border-white/20 flex items-center h-full p-4">
                                        <div class="gallery-card-image-wrapper">
                                            <img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=1974&auto=format&fit=crop"
                                                alt="Hemat Waktu & Tenaga" class="gallery-card-image">
                                        </div>
                                        <div class="gallery-card-content pl-5 text-blue-400">
                                            <h4 class="font-semibold text-lg">Cepat & Efisien</h4>
                                            <p class="text-sm text-blue-400 mt-2">Hemat waktu dan tenaga Anda, biarkan
                                                kami yang mengurus sepatu kotor Anda.</p>
                                            <button
                                                class="gallery-modal-trigger mt-4 w-10 h-10 rounded-full border border-blue-400/40 flex items-center justify-center hover:bg-blue-400/20 transition"
                                                data-image="https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=1974&auto=format&fit=crop"
                                                data-title="Proses Cepat, Hasil Maksimal"
                                                data-description="Dengan teknik pembersihan modern dan peralatan efisien, kami dapat menyelesaikan layanan Quick Clean hanya dalam 15-20 menit.">
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="gallery-card">
                                    <div
                                        class="bg-black/10 backdrop-blur-lg border border-white/20 flex items-center h-full p-4">
                                        <div class="gallery-card-image-wrapper">
                                            <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012&auto=format&fit=crop"
                                                alt="Perlindungan Ekstra" class="gallery-card-image">
                                        </div>
                                        <div class="gallery-card-content pl-5 text-blue-400">
                                            <h4 class="font-semibold text-lg">Perlindungan Ekstra</h4>
                                            <p class="text-sm text-blue-400 mt-2">Lapisan pelindung anti air dan noda
                                                untuk sepatu Anda.</p>
                                            <button
                                                class="gallery-modal-trigger mt-4 w-10 h-10 rounded-full border border-blue-400/40 flex items-center justify-center hover:bg-blue-400/20 transition"
                                                data-image="https://images.unsplash.com/photo-1549298916-b41d501d3772?q=80&w=2012&auto=format&fit=crop"
                                                data-title="Water Repellent Coating"
                                                data-description="Setelah dibersihkan, tambahkan layanan lapisan pelindung (coating) agar sepatu tetap bersih lebih lama.">
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="layanan" class="py-20 px-6 bg-gray-50">
            <div class="container mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Layanan & Harga Kami</h2>
                    <p class="text-lg text-gray-600 mt-2">Pilih paket yang paling sesuai dengan kebutuhan sepatumu.</p>
                    <div class="w-24 h-1 bg-cyan-custom mx-auto mt-4"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start max-w-7xl mx-auto">
                    <div
                        class="service-card bg-white rounded-lg shadow-md p-8 border border-gray-200 flex flex-col h-full fade-in">
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-800">Quick Clean</h3>
                            <p class="text-gray-500 mt-2 mb-6">Pembersihan cepat pada bagian luar untuk noda ringan.</p>
                            <div class="text-4xl font-extrabold text-gray-900 mb-1">Rp 25.000</div>
                            <p class="text-gray-500 mb-8">/pasang</p>
                            <div class="w-full h-px bg-gray-200 mb-8"></div>
                            <p class="font-semibold text-gray-700 mb-4">Yang Anda dapatkan:</p>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center"><i class="fas fa-check-circle text-cyan-custom w-6"></i>
                                    Cuci Upper & Midsole</li>
                                <li class="flex items-center"><i class="fas fa-times-circle text-gray-400 w-6"></i> Cuci
                                    Outsole</li>
                                <li class="flex items-center"><i class="fas fa-times-circle text-gray-400 w-6"></i> Cuci
                                    Tali & Insole</li>
                            </ul>
                        </div>
                        <div class="mt-10"><a href="/login"
                                class="block w-full text-center bg-white text-cyan-custom font-bold py-3 px-6 rounded-lg border-2 border-cyan-custom transition hover:bg-cyan-custom hover:text-white">Pesan
                                Sekarang</a></div>
                    </div>
                    <div
                        class="service-card relative bg-cyan-custom rounded-lg shadow-2xl shadow-cyan-glow/50 p-8 text-white flex flex-col h-full lg:scale-105 fade-in">
                        <div
                            class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-amber-400 text-gray-900 font-semibold px-4 py-1 rounded-full text-sm">
                            Paling Populer</div>
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold">Deep Clean</h3>
                            <p class="text-gray-200 mt-2 mb-6">Pembersihan total luar dan dalam untuk hasil maksimal.
                            </p>
                            <div class="text-4xl font-extrabold mb-1">Rp 45.000</div>
                            <p class="text-gray-300 mb-8">/pasang</p>
                            <div class="w-full h-px bg-cyan-400 mb-8"></div>
                            <p class="font-semibold mb-4">Yang Anda dapatkan:</p>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check-circle text-white w-6"></i> Cuci
                                    Upper & Midsole</li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-white w-6"></i> Cuci
                                    Outsole</li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-white w-6"></i> Cuci
                                    Tali & Insole</li>
                                <li class="flex items-center"><i class="fas fa-star text-amber-300 w-6"></i> Pembersihan
                                    Menyeluruh</li>
                            </ul>
                        </div>
                        <div class="mt-10"><a href="/login"
                                class="block w-full text-center bg-white text-cyan-custom font-bold py-3 px-6 rounded-lg transition hover:bg-gray-100">Pesan
                                Sekarang</a></div>
                    </div>
                    <div
                        class="service-card bg-white rounded-lg shadow-md p-8 border border-gray-200 flex flex-col h-full fade-in">
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-800">Unyellowing</h3>
                            <p class="text-gray-500 mt-2 mb-6">Treatment khusus untuk mengembalikan warna putih midsole.
                            </p>
                            <div class="text-4xl font-extrabold text-gray-900 mb-1">Rp 35.000</div>
                            <p class="text-gray-500 mb-8">/pasang</p>
                            <div class="w-full h-px bg-gray-200 mb-8"></div>
                            <p class="font-semibold text-gray-700 mb-4">Yang Anda dapatkan:</p>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center"><i class="fas fa-check-circle text-cyan-custom w-6"></i>
                                    Treatment Midsole Kuning</li>
                                <li class="flex items-center"><i class="fas fa-info-circle text-gray-400 w-6"></i> Bukan
                                    paket cuci</li>
                                <li class="flex items-center"><i class="fas fa-info-circle text-gray-400 w-6"></i>
                                    Optimal dengan Deep Clean</li>
                            </ul>
                        </div>
                        <div class="mt-10"><a href="/login"
                                class="block w-full text-center bg-white text-cyan-custom font-bold py-3 px-6 rounded-lg border-2 border-cyan-custom transition hover:bg-cyan-custom hover:text-white">Pesan
                                Sekarang</a></div>
                    </div>
                </div>
            </div>
        </section>
        <section id="faq" class="py-20 bg-white">
            <div class="container mx-auto px-6 max-w-5xl">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Frequently Asked Questions</h2>
                </div>
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg fade-in shadow-sm overflow-hidden"><button
                            class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold"><span>Berapa
                                lama proses pengerjaannya?</span><i class="fas fa-chevron-down"></i></button>
                        <div class="faq-content">
                            <div class="p-5 pt-0 text-gray-600">
                                <p>Untuk Quick Clean, prosesnya sekitar 15-20 menit. Sedangkan Deep Clean bisa memakan
                                    waktu 30-45 menit tergantung tingkat kotoran sepatu Anda.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg fade-in shadow-sm overflow-hidden"><button
                            class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold"><span>Apakah
                                bahan pembersihnya aman?</span><i class="fas fa-chevron-down"></i></button>
                        <div class="faq-content">
                            <div class="p-5 pt-0 text-gray-600">
                                <p>Tentu saja! Kami menggunakan cairan pembersih premium yang diformulasikan khusus
                                    untuk bahan sepatu (kanvas, suede, kulit, dll) sehingga aman dan tidak merusak warna
                                    atau material.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg fade-in shadow-sm overflow-hidden"><button
                            class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold"><span>Bagaimana
                                cara melakukan pembayaran?</span><i class="fas fa-chevron-down"></i></button>
                        <div class="faq-content">
                            <div class="p-5 pt-0 text-gray-600">
                                <p>Kami menerima pembayaran tunai dan non-tunai melalui QRIS di semua gerobak kami yang
                                    aktif.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="kontak" class="py-20 px-6 bg-gray-50">
            <div class="container mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Kami Siap Mendengar dari Anda</h2>
                    <p class="text-lg text-gray-600 mt-2">Punya pertanyaan, saran, atau ide kolaborasi? Jangan ragu
                        hubungi kami.</p>
                    <div class="w-24 h-1 bg-cyan-custom mx-auto mt-4"></div>
                </div>
                <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden fade-in">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        <div class="bg-cyan-custom text-white p-8 md:p-10 flex flex-col justify-center">
                            <div>
                                <h3 class="text-3xl font-bold mb-4">Info Kontak</h3>
                                <p class="text-cyan-100 mb-8 max-w-md">Anda bisa menghubungi kami langsung melalui
                                    telepon atau email selama jam operasional kami.</p>
                                <div class="space-y-6">
                                    <div class="flex items-center"><i class="fas fa-phone-alt w-6 h-6 text-2xl"></i>
                                        <div class="ml-4">
                                            <h4 class="font-semibold text-lg">Telepon</h4>
                                            <p class="text-cyan-200">+62 812-3456-7890</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center"><i class="fas fa-envelope w-6 h-6 text-2xl"></i>
                                        <div class="ml-4">
                                            <h4 class="font-semibold text-lg">Email</h4>
                                            <p class="text-cyan-200">yakotoryacuci@gmail.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-8 md:p-10">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">Tinggalkan Pesan</h3>
                            <form action="#" method="POST">
                                <div class="mb-5"><label for="nama_saran"
                                        class="block text-gray-700 font-semibold mb-2">Nama Anda</label><input
                                        type="text" id="nama_saran" name="nama_saran"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ring-cyan-custom transition"
                                        placeholder="Tulis nama lengkap Anda"></div>
                                <div class="mb-5"><label for="email_saran"
                                        class="block text-gray-700 font-semibold mb-2">Alamat Email</label><input
                                        type="email" id="email_saran" name="email_saran"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ring-cyan-custom transition"
                                        placeholder="Contoh: email@anda.com"></div>
                                <div class="mb-6"><label for="pesan_saran"
                                        class="block text-gray-700 font-semibold mb-2">Pesan Anda</label><textarea
                                        id="pesan_saran" name="pesan_saran" rows="5"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ring-cyan-custom transition"
                                        placeholder="Tuliskan pesan, saran, atau pertanyaan Anda di sini..."
                                        required></textarea></div>
                                <button type="submit"
                                    class="w-full bg-cyan-custom text-white font-bold py-3 px-6 rounded-lg transition hover:bg-opacity-90">Kirim
                                    Pesan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-900 text-gray-300">
        <div class="container mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <div class="md:col-span-12 lg:col-span-4">
                    <a href="#home" class="flex items-center mb-4"><img class="h-10 mr-3" src="/images/favicon-dark.svg"
                            alt="YKYc Logo" style="filter: brightness(0) invert(1);"><span
                            class="text-2xl font-bold text-white">Ya Kotor Ya Cuci</span></a>
                    <p class="text-gray-400 max-w-md">Revolusi jasa laundry sepatu dengan konsep gerobak portabel.
                        Cepat, bersih, praktis, dan hadir lebih dekat untuk Anda.</p>
                </div>
                <div class="md:col-span-4 lg:col-span-2">
                    <h3 class="font-bold text-lg mb-4 text-white tracking-wider">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="#home" class="hover:text-cyan-custom transition-colors duration-300">Home</a></li>
                        <li><a href="#layanan" class="hover:text-cyan-custom transition-colors duration-300">Layanan</a>
                        </li>
                        <li><a href="#faq" class="hover:text-cyan-custom transition-colors duration-300">FAQ</a></li>
                        <li><a href="#kontak" class="hover:text-cyan-custom transition-colors duration-300">Kontak</a>
                        </li>
                    </ul>
                </div>
                <div class="md:col-span-4 lg:col-span-3">
                    <h3 class="font-bold text-lg mb-4 text-white tracking-wider">Kantor Pusat</h3>
                    <div class="flex text-gray-400"><i
                            class="fas fa-map-marker-alt w-5 mr-3 mt-1 text-cyan-custom"></i><span>Jalan Bunga Coklat
                            No. 10, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</span></div>
                </div>
            </div>
        </div>
        <div class="bg-gray-950 py-6 px-6">
            <div
                class="container mx-auto flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <p class="text-sm text-gray-500 mb-4 md:mb-0">&copy; 2025 Ya Kotor Ya Cuci. All Rights Reserved.</p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white hover:bg-cyan-custom transition-colors duration-300"><i
                            class="fab fa-facebook-f"></i></a>
                    <a href="#"
                        class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white hover:bg-cyan-custom transition-colors duration-300"><i
                            class="fab fa-instagram"></i></a>
                    <a href="#"
                        class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white hover:bg-cyan-custom transition-colors duration-300"><i
                            class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <div id="modal-container"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 opacity-0 pointer-events-none z-50">
        <div id="modal-box" class="bg-white rounded-lg shadow-xl w-full max-w-3xl overflow-hidden transform scale-95">
            <!-- === PERUBAHAN UTAMA DI SINI === -->
            <div class="grid md:grid-cols-2">
                <div class="p-8 order-2 md:order-1 flex flex-col">
                    <div class="flex-grow">
                        <h3 id="modal-title" class="text-2xl font-bold text-gray-800 mb-4"></h3>
                        <p id="modal-description" class="text-gray-600 leading-relaxed"></p>
                    </div>
                    <button id="modal-close-button"
                        class="mt-8 w-full bg-cyan-custom text-white font-bold py-3 px-6 rounded-lg transition hover:bg-opacity-90 flex-shrink-0">Tutup</button>
                </div>
                <div class="order-1 md:order-2">
                    <!-- Tinggi gambar diatur di sini untuk konsistensi -->
                    <img id="modal-image" src="" alt="Detail Gambar" class="w-full h-64 md:h-[450px] object-cover">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // SCRIPT NAVBAR, FAQ, FADE-IN, HERO (TIDAK BERUBAH)
            const header = document.getElementById('main-header'); const headerLogo = document.getElementById('header-logo'); const mobileMenuButton = document.getElementById('mobile-menu-button'); const mobileMenu = document.getElementById('mobile-menu'); window.addEventListener('scroll', () => { if (window.scrollY > 50) { header.classList.add('bg-white', 'text-gray-800', 'shadow-md'); header.classList.remove('text-white', 'nav-glassmorphism'); headerLogo.classList.remove('brightness-0', 'invert'); } else { header.classList.remove('bg-white', 'text-gray-800', 'shadow-md'); header.classList.add('text-white', 'nav-glassmorphism'); headerLogo.classList.add('brightness-0', 'invert'); } }); mobileMenuButton.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); }); const faqToggles = document.querySelectorAll('.faq-toggle'); faqToggles.forEach(toggle => { toggle.addEventListener('click', () => { const content = toggle.nextElementSibling; toggle.classList.toggle('open'); content.classList.toggle('open'); }); }); const fadeInElements = document.querySelectorAll('.fade-in'); const observer = new IntersectionObserver((entries) => { entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); }); }, { threshold: 0.1 }); fadeInElements.forEach(el => { observer.observe(el); }); const slideshowImages = document.querySelectorAll('.hero-slideshow-image'); let currentImageIndex = 0; if (slideshowImages.length > 0) slideshowImages[0].classList.add('active'); function changeBackgroundImage() { if (slideshowImages.length === 0) return; slideshowImages[currentImageIndex].classList.remove('active'); currentImageIndex = (currentImageIndex + 1) % slideshowImages.length; slideshowImages[currentImageIndex].classList.add('active'); } setInterval(changeBackgroundImage, 7000);

            // --- SCRIPT CAROUSEL (DENGAN KONTROL PLAY/PAUSE) ---
            const galleryWrapper = document.getElementById('about-gallery-wrapper');
            const gallery = document.getElementById('about-gallery');

            if (gallery && galleryWrapper) {
                const originalCards = Array.from(gallery.children);
                originalCards.forEach(card => {
                    gallery.appendChild(card.cloneNode(true)); // duplikasi untuk efek infinite
                });

                let isPaused = false;

                // auto scroll
                const autoScroll = () => {
                    if (!isPaused) {
                        galleryWrapper.scrollLeft += 0.8;
                    }
                    requestAnimationFrame(autoScroll);
                };

                // infinite scroll
                const handleInfiniteScroll = () => {
                    const itemSetWidth = gallery.scrollWidth / 2;
                    if (galleryWrapper.scrollLeft >= itemSetWidth) {
                        galleryWrapper.scrollLeft -= itemSetWidth;
                    }
                    if (galleryWrapper.scrollLeft <= 0) {
                        galleryWrapper.scrollLeft += itemSetWidth;
                    }
                };
                galleryWrapper.addEventListener('scroll', handleInfiniteScroll);

                // drag manual
                let isDown = false;
                let startX;
                let scrollLeft;

                galleryWrapper.addEventListener('mousedown', (e) => {
                    isDown = true;
                    galleryWrapper.classList.add('cursor-grabbing');
                    startX = e.pageX - galleryWrapper.offsetLeft;
                    scrollLeft = galleryWrapper.scrollLeft;
                    isPaused = true; // stop auto-scroll saat drag
                });

                galleryWrapper.addEventListener('mouseleave', () => {
                    isDown = false;
                    galleryWrapper.classList.remove('cursor-grabbing');
                    isPaused = false;
                });

                galleryWrapper.addEventListener('mouseup', () => {
                    isDown = false;
                    galleryWrapper.classList.remove('cursor-grabbing');
                    isPaused = false;
                });

                galleryWrapper.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - galleryWrapper.offsetLeft;
                    const walk = (x - startX) * 2;
                    galleryWrapper.scrollLeft = scrollLeft - walk;
                });

                galleryWrapper.addEventListener('mouseenter', () => isPaused = true);
                galleryWrapper.addEventListener('mouseleave', () => isPaused = false);

                requestAnimationFrame(autoScroll);
            }

            // --- SCRIPT MODAL ---
            const modalContainer = document.getElementById('modal-container');
            const modalBox = document.getElementById('modal-box');
            const modalCloseButton = document.getElementById('modal-close-button');
            const modalTitle = document.getElementById('modal-title');
            const modalDescription = document.getElementById('modal-description');
            const modalImage = document.getElementById('modal-image');

            const openModal = (trigger) => {
                isPaused = true;
                modalTitle.textContent = trigger.dataset.title;
                modalDescription.textContent = trigger.dataset.description;
                modalImage.src = trigger.dataset.image;
                modalContainer.classList.remove('opacity-0', 'pointer-events-none');
                modalBox.classList.remove('scale-95');
            };
            const closeModal = () => {
                modalContainer.classList.add('opacity-0', 'pointer-events-none');
                modalBox.classList.add('scale-95');
                if (playPauseIcon && playPauseIcon.classList.contains('fa-pause')) {
                    isPaused = false;
                }
            };

            document.body.addEventListener('click', function (e) {
                const trigger = e.target.closest('.gallery-modal-trigger');
                if (trigger) {
                    openModal(trigger);
                }
            });

            modalCloseButton.addEventListener('click', closeModal);
            modalContainer.addEventListener('click', (e) => (e.target === modalContainer) && closeModal());
            document.addEventListener('keydown', (e) => (e.key === 'Escape') && closeModal());
        });
    </script>

</body>

</html>