<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ya Kotor Ya Cuci (YKYc) - Jasa Laundry Sepatu Profesional</title>
    <meta name="description" content="YKYc adalah jasa laundry sepatu portabel dengan konsep gerobak. Cepat, bersih, dan dekat dengan Anda.">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        
        .hero-section { 
            position: relative;
            overflow: hidden;
            background-color: #333;
        }
        .text-cyan-custom { color: #00B2EE; }
        .bg-cyan-custom { background-color: #00B2EE; }
        .bg-cyan-custom:hover { background-color: #009BD6; }
        .border-cyan-custom { border-color: #00B2EE; }
        .ring-cyan-custom:focus { ring-color: #00B2EE; }
        
        .shadow-cyan-glow { box-shadow: 0 0 20px rgba(0, 178, 238, 0.4); transition: box-shadow 0.3s ease-in-out; }
        .group:hover .shadow-cyan-glow { box-shadow: 0 0 35px rgba(0, 178, 238, 0.7); }
        
        .fade-in { opacity: 0; transform: translateY(20px); transition: opacity 0.6s ease-out, transform 0.6s ease-out; }
        .fade-in.visible { opacity: 1; transform: translateY(0); }
        .clip-waterdrop-solid { clip-path: url(#waterdrop-shape-solid); }

        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-12px); } }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .draggable-group { cursor: grab; user-select: none; }
        .draggable-group.dragging { cursor: grabbing; z-index: 1000; }
        .draggable-group.dragging .animate-float { animation: none; }
        .snapping-back { transition: top 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), left 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .cursor-hidden { cursor: none; }

        .faq-toggle i { transition: transform 0.3s ease-in-out; }
        .faq-toggle.open i { transform: rotate(180deg); }
        .faq-content { max-height: 0; overflow: hidden; transition: max-height 0.5s ease-in-out; }
        .faq-content.open { max-height: 200px; }
        
        .service-card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        /* CSS untuk Hero Slideshow */
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

        /* --- KODE GLASSMORPHISM: Kelas untuk efek Glassmorphism pada Navbar --- */
        .nav-glassmorphism {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        /* --- AKHIR KODE GLASSMORPHISM --- */
    </style>
</head>
<body class="bg-white text-gray-800">
    
    <svg class="absolute w-0 h-0"><defs><clipPath id="waterdrop-shape-solid" clipPathUnits="objectBoundingBox"><path d="M0.5,1 C0.15,1 0,0.8 0.3,0.4 C0.4,0.25 0.5,0.1 0.5,0.1 C0.5,0.1 0.6,0.25 0.7,0.4 C1,0.8 0.85,1 0.5,1 Z" /></clipPath></defs></svg>
    
    <!-- KODE GLASSMORPHISM: Tambahkan class 'nav-glassmorphism' sebagai state awal -->
    <header id="main-header" class="fixed top-0 left-0 right-0 z-50 text-white transition-all duration-300 nav-glassmorphism">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#home"><img id="header-logo" class="h-10 brightness-0 invert transition-all duration-300" src="/images/favicon-dark.svg" alt="YKYc Logo"></a>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#home" class="hover:text-cyan-custom transition">Home</a>
                    <a href="#layanan" class="hover:text-cyan-custom transition">Layanan</a>
                    <a href="#faq" class="hover:text-cyan-custom transition">FAQ</a>
                    <a href="#kontak" class="hover:text-cyan-custom transition">Kontak</a>
                    <div class="flex items-center space-x-2 pl-4">
                         <a href="/login" class="px-5 py-2 border rounded-full hover:bg-white hover:text-black transition text-sm font-semibold">Login</a>
                         <a href="/register" class="px-5 py-2 bg-cyan-custom text-white rounded-full hover:bg-opacity-80 transition text-sm font-semibold">Register</a>
                    </div>
                </div>
                <div class="md:hidden"><button id="mobile-menu-button" class="focus:outline-none"><i class="fas fa-bars text-2xl"></i></button></div>
            </div>
            <div id="mobile-menu" class="hidden md:hidden mt-4 bg-black bg-opacity-80 backdrop-blur-sm rounded-lg p-4">
                <a href="#home" class="block py-2 px-3 text-white hover:bg-gray-700 rounded">Home</a><a href="#layanan" class="block py-2 px-3 text-white hover:bg-gray-700 rounded">Layanan</a><a href="#faq" class="block py-2 px-3 text-white hover:bg-gray-700 rounded">FAQ</a><a href="#kontak" class="block py-2 px-3 text-white hover:bg-gray-700 rounded">Kontak</a>
                <div class="mt-4 pt-4 border-t border-gray-600"><a href="/login" class="block w-full text-center px-4 py-2 text-cyan-custom border border-cyan-custom rounded-md hover:bg-cyan-custom hover:text-white transition mb-2">Login</a><a href="/register" class="block w-full text-center px-4 py-2 bg-cyan-custom text-white rounded-md hover:bg-opacity-80 transition">Register</a></div>
            </div>
        </nav>
    </header>

    <main>
        <section id="home" class="hero-section h-screen flex items-center justify-center text-white text-center">
            
            <div class="hero-slideshow">
                <div class="hero-slideshow-image active" style="background-image: url('https://i.pinimg.com/1200x/a3/e1/ce/a3e1ceb20b3cb96d1317472e1aa8235a.jpg');"></div>
                <div class="hero-slideshow-image" style="background-image: url('https://images.unsplash.com/photo-1608231387042-66d1773070a5?q=80&w=1974&auto=format&fit=crop');"></div>
                <div class="hero-slideshow-image" style="background-image: url('https://images.unsplash.com/photo-1552346154-21d32810aba3?q=80&w=2070&auto=format&fit=crop');"></div>
                <div class="hero-slideshow-image" style="background-image: url('https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?q=80&w=1974&auto=format&fit=crop');"></div>
            </div>
            
            <div class="bg-black bg-opacity-50 inset-0 absolute z-10"></div>
            
            <div class="relative z-20 px-4">
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">Ya Kotor Ya Cuci</h1>
                <p class="mt-4 text-xl md:text-2xl font-semibold max-w-3xl mx-auto">Solusi laundry sepatu cepat dan praktis langsung dari gerobak portabel kami. Sepatu bersih kinclong dalam sekejap!</p>
                <a href="#layanan" class="mt-8 inline-block bg-cyan-custom text-white font-bold py-3 px-10 rounded-full transition">Lihat Layanan Kami</a>
            </div>
        </section>
        
        <section class="py-20 px-6 overflow-hidden"><div class="container mx-auto"><div class="text-center mb-12"><h2 class="text-3xl md:text-4xl font-bold">KENAPA YKYc?</h2><div class="w-24 h-1 bg-cyan-custom mx-auto mt-4"></div></div><p class="max-w-4xl mx-auto text-center text-gray-600 mb-8 md:mb-16">Ya Kotor Ya Cuci (YKYc) adalah revolusi dalam perawatan sepatu, menghadirkan jasa laundry profesional langsung ke tempat Anda melalui konsep gerobak portabel yang unik. Kami percaya bahwa sepatu bersih adalah hak semua orang, di mana pun mereka berada.</p><div class="relative flex flex-col md:flex-row justify-center items-center md:min-h-[550px]"><div class="md:hidden flex flex-col items-center gap-8 w-full"><h3 class="text-xl font-bold mb-1">Cepat & Praktis</h3><p class="text-gray-500 max-w-xs">Layanan ekspres di tempat, tak perlu menunggu berhari-hari.</p><h3 class="text-xl font-bold mb-1">Teknisi Profesional</h3><p class="text-gray-500 max-w-xs">Dikerjakan oleh tim yang ahli di bidang perawatan sepatu.</p><div class="w-72 h-96 my-4 clip-waterdrop-solid shadow-2xl"><img src="https://i.ibb.co.com/BHs9DfNK/2025-0_2-16-17-23-IMG-0201.jpg" alt="Pembersihan sepatu" class="w-full h-full object-cover"></div><h3 class="text-xl font-bold mb-1">Hasil Maksimal</h3><p class="text-gray-500 max-w-xs">Menggunakan pembersih premium yang aman untuk semua bahan.</p><h3 class="text-xl font-bold mb-1">Harga Terjangkau</h3><p class="text-gray-500 max-w-xs">Kualitas premium dengan harga yang ramah di kantong.</p></div><div id="interactive-container" class="hidden md:block relative w-full min-h-[550px]"><div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 w-96 h-[480px] clip-waterdrop-solid shadow-2xl"><img src="https://i.ibb.co.com/BHs9DfNK/2025-02-16-17-23-IMG-0201.jpg" alt="Pembersihan sepatu" class="w-full h-full object-cover"></div><div class="absolute top-0 left-0 right-0 bottom-0 z-20"><div class="group draggable-group absolute top-[15%] left-[12%]"><div class="relative flex flex-row-reverse items-center gap-4"><div class="animate-float" style="animation-delay: 0s;"><div class="w-20 h-20 rounded-full bg-white border-2 border-cyan-custom shadow-cyan-glow flex items-center justify-center transition-colors duration-300 group-hover:bg-sky-500"><i class="fas fa-bolt text-3xl text-cyan-custom transition-colors duration-300 group-hover:text-white"></i></div></div><div class="opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 -translate-x-4 group-hover:translate-x-0 text-right"><h3 class="text-xl font-bold mb-1">Cepat & Praktis</h3><p class="text-gray-500 w-52">Layanan ekspres di tempat, tak perlu menunggu.</p></div></div></div><div class="group draggable-group absolute bottom-[15%] left-[16%]"><div class="relative flex flex-row-reverse items-center gap-4"><div class="animate-float" style="animation-delay: 1s;"><div class="w-20 h-20 rounded-full bg-white border-2 border-cyan-custom shadow-cyan-glow flex items-center justify-center transition-colors duration-300 group-hover:bg-sky-500"><i class="fas fa-user-gear text-3xl text-cyan-custom transition-colors duration-300 group-hover:text-white"></i></div></div><div class="opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 -translate-x-4 group-hover:translate-x-0 text-right"><h3 class="text-xl font-bold mb-1">Teknisi Profesional</h3><p class="text-gray-500 w-52">Dikerjakan oleh tim yang ahli di bidangnya.</p></div></div></div><div class="group draggable-group absolute top-[15%] right-[12%]"><div class="relative flex flex-row items-center gap-4"><div class="animate-float" style="animation-delay: 2s;"><div class="w-20 h-20 rounded-full bg-white border-2 border-cyan-custom shadow-cyan-glow flex items-center justify-center transition-colors duration-300 group-hover:bg-sky-500"><i class="fas fa-gem text-3xl text-cyan-custom transition-colors duration-300 group-hover:text-white"></i></div></div><div class="opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-x-4 group-hover:translate-x-0 text-left"><h3 class="text-xl font-bold mb-1">Hasil Maksimal</h3><p class="text-gray-500 w-52">Pembersih premium yang aman untuk semua bahan.</p></div></div></div><div class="group draggable-group absolute bottom-[15%] right-[16%]"><div class="relative flex flex-row items-center gap-4"><div class="animate-float" style="animation-delay: 3s;"><div class="w-20 h-20 rounded-full bg-white border-2 border-cyan-custom shadow-cyan-glow flex items-center justify-center transition-colors duration-300 group-hover:bg-sky-500"><i class="fas fa-wallet text-3xl text-cyan-custom transition-colors duration-300 group-hover:text-white"></i></div></div><div class="opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-x-4 group-hover:translate-x-0 text-left"><h3 class="text-xl font-bold mb-1">Harga Terjangkau</h3><p class="text-gray-500 w-52">Kualitas premium dengan harga yang ramah di kantong.</p></div></div></div></div></div></div></section>
        
        <section id="layanan" class="py-20 px-6 bg-gray-50">
            <div class="container mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Layanan & Harga Kami</h2>
                    <p class="text-lg text-gray-600 mt-2">Pilih paket yang paling sesuai dengan kebutuhan sepatumu.</p>
                    <div class="w-24 h-1 bg-cyan-custom mx-auto mt-4"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-start max-w-7xl mx-auto">

                    <div class="service-card bg-white rounded-lg shadow-md p-8 border border-gray-200 flex flex-col h-full fade-in">
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-800">Quick Clean</h3>
                            <p class="text-gray-500 mt-2 mb-6">Pembersihan cepat pada bagian luar untuk noda ringan.</p>
                            <div class="text-4xl font-extrabold text-gray-900 mb-1">Rp 25.000</div>
                            <p class="text-gray-500 mb-8">/pasang</p>
                            
                            <div class="w-full h-px bg-gray-200 mb-8"></div>

                            <p class="font-semibold text-gray-700 mb-4">Yang Anda dapatkan:</p>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center"><i class="fas fa-check-circle text-cyan-custom w-6"></i> Cuci Upper & Midsole</li>
                                <li class="flex items-center"><i class="fas fa-times-circle text-gray-400 w-6"></i> Cuci Outsole</li>
                                <li class="flex items-center"><i class="fas fa-times-circle text-gray-400 w-6"></i> Cuci Tali & Insole</li>
                            </ul>
                        </div>
                        <div class="mt-10">
                            <a href="/login" class="block w-full text-center bg-white text-cyan-custom font-bold py-3 px-6 rounded-lg border-2 border-cyan-custom transition hover:bg-cyan-custom hover:text-white">Pesan Sekarang</a>
                        </div>
                    </div>

                    <div class="service-card relative bg-cyan-custom rounded-lg shadow-2xl shadow-cyan-glow/50 p-8 text-white flex flex-col h-full lg:scale-105 fade-in">
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-amber-400 text-gray-900 font-semibold px-4 py-1 rounded-full text-sm">
                            Paling Populer
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold">Deep Clean</h3>
                            <p class="text-gray-200 mt-2 mb-6">Pembersihan total luar dan dalam untuk hasil maksimal.</p>
                            <div class="text-4xl font-extrabold mb-1">Rp 45.000</div>
                            <p class="text-gray-300 mb-8">/pasang</p>
                            
                            <div class="w-full h-px bg-cyan-400 mb-8"></div>

                            <p class="font-semibold mb-4">Yang Anda dapatkan:</p>
                            <ul class="space-y-3">
                                <li class="flex items-center"><i class="fas fa-check-circle text-white w-6"></i> Cuci Upper & Midsole</li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-white w-6"></i> Cuci Outsole</li>
                                <li class="flex items-center"><i class="fas fa-check-circle text-white w-6"></i> Cuci Tali & Insole</li>
                                <li class="flex items-center"><i class="fas fa-star text-amber-300 w-6"></i> Pembersihan Menyeluruh</li>
                            </ul>
                        </div>
                        <div class="mt-10">
                            <a href="/login" class="block w-full text-center bg-white text-cyan-custom font-bold py-3 px-6 rounded-lg transition hover:bg-gray-100">Pesan Sekarang</a>
                        </div>
                    </div>

                    <div class="service-card bg-white rounded-lg shadow-md p-8 border border-gray-200 flex flex-col h-full fade-in">
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-gray-800">Unyellowing</h3>
                            <p class="text-gray-500 mt-2 mb-6">Treatment khusus untuk mengembalikan warna putih midsole.</p>
                            <div class="text-4xl font-extrabold text-gray-900 mb-1">Rp 35.000</div>
                            <p class="text-gray-500 mb-8">/pasang</p>
                            
                            <div class="w-full h-px bg-gray-200 mb-8"></div>

                            <p class="font-semibold text-gray-700 mb-4">Yang Anda dapatkan:</p>
                            <ul class="space-y-3 text-gray-600">
                                <li class="flex items-center"><i class="fas fa-check-circle text-cyan-custom w-6"></i> Treatment Midsole Kuning</li>
                                <li class="flex items-center"><i class="fas fa-info-circle text-gray-400 w-6"></i> Bukan paket cuci</li>
                                <li class="flex items-center"><i class="fas fa-info-circle text-gray-400 w-6"></i> Optimal dengan Deep Clean</li>
                            </ul>
                        </div>
                        <div class="mt-10">
                            <a href="/login" class="block w-full text-center bg-white text-cyan-custom font-bold py-3 px-6 rounded-lg border-2 border-cyan-custom transition hover:bg-cyan-custom hover:text-white">Pesan Sekarang</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section id="faq" class="py-20 bg-white"><div class="container mx-auto px-6 max-w-5xl"><div class="text-center mb-12"><h2 class="text-3xl md:text-4xl font-bold text-gray-900">Frequently Asked Questions</h2></div><div class="space-y-4"><div class="bg-gray-50 rounded-lg fade-in shadow-sm overflow-hidden"><button class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold"><span>Berapa lama proses pengerjaannya?</span><i class="fas fa-chevron-down"></i></button><div class="faq-content"><div class="p-5 pt-0 text-gray-600"><p>Untuk Quick Clean, prosesnya sekitar 15-20 menit. Sedangkan Deep Clean bisa memakan waktu 30-45 menit tergantung tingkat kotoran sepatu Anda.</p></div></div></div><div class="bg-gray-50 rounded-lg fade-in shadow-sm overflow-hidden"><button class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold"><span>Apakah bahan pembersihnya aman?</span><i class="fas fa-chevron-down"></i></button><div class="faq-content"><div class="p-5 pt-0 text-gray-600"><p>Tentu saja! Kami menggunakan cairan pembersih premium yang diformulasikan khusus untuk bahan sepatu (kanvas, suede, kulit, dll) sehingga aman dan tidak merusak warna atau material.</p></div></div></div><div class="bg-gray-50 rounded-lg fade-in shadow-sm overflow-hidden"><button class="faq-toggle flex justify-between items-center w-full p-5 text-left font-semibold"><span>Bagaimana cara melakukan pembayaran?</span><i class="fas fa-chevron-down"></i></button><div class="faq-content"><div class="p-5 pt-0 text-gray-600"><p>Kami menerima pembayaran tunai dan non-tunai melalui QRIS di semua gerobak kami yang aktif.</p></div></div></div></div></div></section>
        
        <section id="kontak" class="py-20 px-6 bg-gray-50">
            <div class="container mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Kami Siap Mendengar dari Anda</h2>
                    <p class="text-lg text-gray-600 mt-2">Punya pertanyaan, saran, atau ide kolaborasi? Jangan ragu hubungi kami.</p>
                    <div class="w-24 h-1 bg-cyan-custom mx-auto mt-4"></div>
                </div>
                
                <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden fade-in">
                    <div class="grid grid-cols-1 lg:grid-cols-2">
                        
                        <div class="bg-cyan-custom text-white p-8 md:p-10 flex flex-col justify-center">
                            <div>
                                <h3 class="text-3xl font-bold mb-4">Info Kontak</h3>
                                <p class="text-cyan-100 mb-8 max-w-md">
                                    Anda bisa menghubungi kami langsung melalui telepon atau email selama jam operasional kami.
                                </p>
                                <div class="space-y-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-phone-alt w-6 h-6 text-2xl"></i>
                                        <div class="ml-4">
                                            <h4 class="font-semibold text-lg">Telepon</h4>
                                            <p class="text-cyan-200">+62 812-3456-7890</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope w-6 h-6 text-2xl"></i>
                                        <div class="ml-4">
                                            <h4 class="font-semibold text-lg">Email</h4>
                                            <p class="text-cyan-200">layanan@ykyc.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                        <div class="p-8 md:p-10">
                            <h3 class="text-2xl font-bold mb-6 text-gray-800">Tinggalkan Pesan</h3>
                            <form action="#" method="POST">
                                <div class="mb-5">
                                    <label for="nama_saran" class="block text-gray-700 font-semibold mb-2">Nama Anda</label>
                                    <input type="text" id="nama_saran" name="nama_saran" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ring-cyan-custom transition" placeholder="Tulis nama lengkap Anda">
                                </div>
                                <div class="mb-5">
                                    <label for="email_saran" class="block text-gray-700 font-semibold mb-2">Alamat Email</label>
                                    <input type="email" id="email_saran" name="email_saran" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ring-cyan-custom transition" placeholder="Contoh: email@anda.com">
                                </div>
                                <div class="mb-6">
                                    <label for="pesan_saran" class="block text-gray-700 font-semibold mb-2">Pesan Anda</label>
                                    <textarea id="pesan_saran" name="pesan_saran" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 ring-cyan-custom transition" placeholder="Tuliskan pesan, saran, atau pertanyaan Anda di sini..." required></textarea>
                                </div>
                                <button type="submit" class="w-full bg-cyan-custom text-white font-bold py-3 px-6 rounded-lg transition hover:bg-opacity-90">
                                    Kirim Pesan
                                </button>
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
                    <a href="#home" class="flex items-center mb-4">
                        <img class="h-10 mr-3" src="/images/favicon-dark.svg" alt="YKYc Logo" style="filter: brightness(0) invert(1);">
                        <span class="text-2xl font-bold text-white">Ya Kotor Ya Cuci</span>
                    </a>
                    <p class="text-gray-400 max-w-md">
                        Revolusi jasa laundry sepatu dengan konsep gerobak portabel. Cepat, bersih, praktis, dan hadir lebih dekat untuk Anda.
                    </p>
                </div>

                <div class="md:col-span-4 lg:col-span-2">
                    <h3 class="font-bold text-lg mb-4 text-white tracking-wider">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="#home" class="hover:text-cyan-custom transition-colors duration-300">Home</a></li>
                        <li><a href="#layanan" class="hover:text-cyan-custom transition-colors duration-300">Layanan</a></li>
                        <li><a href="#faq" class="hover:text-cyan-custom transition-colors duration-300">FAQ</a></li>
                        <li><a href="#kontak" class="hover:text-cyan-custom transition-colors duration-300">Kontak</a></li>
                    </ul>
                </div>
                
                <div class="md:col-span-4 lg:col-span-3">
                    <h3 class="font-bold text-lg mb-4 text-white tracking-wider">Kontak Kami</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt w-5 mr-3 text-cyan-custom"></i>
                            <span>+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope w-5 mr-3 text-cyan-custom"></i>
                            <span>hello@ykyc.com</span>
                        </li>
                    </ul>
                </div>

                <div class="md:col-span-4 lg:col-span-3">
                    <h3 class="font-bold text-lg mb-4 text-white tracking-wider">Kantor Pusat</h3>
                    <div class="flex text-gray-400">
                        <i class="fas fa-map-marker-alt w-5 mr-3 mt-1 text-cyan-custom"></i>
                        <span>
                            Jalan Bunga Coklat No. 10,
                            Jatimulyo, Kec. Lowokwaru,
                            Kota Malang, Jawa Timur 65141
                        </span>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="bg-gray-950 py-6 px-6">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <p class="text-sm text-gray-500 mb-4 md:mb-0">
                    &copy; 2025 Ya Kotor Ya Cuci. All Rights Reserved.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white hover:bg-cyan-custom transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white hover:bg-cyan-custom transition-colors duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center text-white hover:bg-cyan-custom transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const header = document.getElementById('main-header');
        const headerLogo = document.getElementById('header-logo');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        // --- KODE GLASSMORPHISM: Logika scroll diupdate ---
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                // Saat di-scroll ke bawah
                header.classList.add('bg-white', 'text-gray-800', 'shadow-md');
                header.classList.remove('text-white', 'nav-glassmorphism'); // Hapus glassmorphism
                headerLogo.classList.remove('brightness-0', 'invert');
                mobileMenuButton.classList.remove('text-white');
                mobileMenuButton.classList.add('text-gray-800');
            } else {
                // Saat kembali di atas
                header.classList.remove('bg-white', 'text-gray-800', 'shadow-md');
                header.classList.add('text-white', 'nav-glassmorphism'); // Tambahkan kembali glassmorphism
                headerLogo.classList.add('brightness-0', 'invert');
                mobileMenuButton.classList.add('text-white');
                mobileMenuButton.classList.remove('text-gray-800');
            }
        });
        // --- AKHIR KODE GLASSMORPHISM ---

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        const faqToggles = document.querySelectorAll('.faq-toggle');
        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const content = toggle.nextElementSibling;
                toggle.classList.toggle('open');
                content.classList.toggle('open');
            });
        });

        const fadeInElements = document.querySelectorAll('.fade-in');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        fadeInElements.forEach(el => { observer.observe(el); });

        const interactiveContainer = document.getElementById('interactive-container');
        if (interactiveContainer) {
            const draggableGroups = interactiveContainer.querySelectorAll('.draggable-group');
            const containerRect = interactiveContainer.getBoundingClientRect();
            const centerY = containerRect.height / 2;

            const SAFE_VERTICAL_RADIUS = 150;
            const SNAP_BACK_VERTICAL_RADIUS = 220;
            const RESISTANCE_FACTOR = 0.4;

            draggableGroups.forEach(element => {
                element.dataset.originalTop = element.offsetTop + 'px';
                element.dataset.originalLeft = element.offsetLeft + 'px';
            
                let offsetX, offsetY, isDragging = false;

                const startDrag = (e) => {
                    isDragging = true;
                    element.classList.add('dragging');
                    document.body.classList.add('cursor-hidden');
                    
                    const event = e.type.includes('touch') ? e.touches[0] : e;
                    const rect = element.getBoundingClientRect();
                    
                    offsetX = event.clientX - rect.left;
                    offsetY = event.clientY - rect.top;

                    element.style.right = 'auto';
                    element.style.bottom = 'auto';

                    document.addEventListener('mousemove', drag);
                    document.addEventListener('touchmove', drag, { passive: false });
                    document.addEventListener('mouseup', stopDrag);
                    document.addEventListener('touchend', stopDrag);
                };

                const drag = (e) => {
                    if (!isDragging) return;
                    e.preventDefault();

                    const event = e.type.includes('touch') ? e.touches[0] : e;
                    const parentRect = interactiveContainer.getBoundingClientRect();
                    
                    let newX = event.clientX - parentRect.left - offsetX;
                    let newY = event.clientY - parentRect.top - offsetY;

                    const elementCenterY = newY + element.offsetHeight / 2;
                    const verticalDistance = Math.abs(elementCenterY - centerY);

                    if (verticalDistance > SAFE_VERTICAL_RADIUS) {
                        const direction = Math.sign(elementCenterY - centerY);
                        const overDistance = verticalDistance - SAFE_VERTICAL_RADIUS;
                        const resistedYFromCenter = (SAFE_VERTICAL_RADIUS + (overDistance * RESISTANCE_FACTOR)) * direction;
                        
                        newY = (centerY + resistedYFromCenter) - element.offsetHeight / 2;
                    }
                    
                    element.style.left = `${newX}px`;
                    element.style.top = `${newY}px`;
                };

                const stopDrag = () => {
                    if (!isDragging) return;
                    isDragging = false;
                    element.classList.remove('dragging');
                    document.body.classList.remove('cursor-hidden');
                    
                    document.removeEventListener('mousemove', drag);
                    document.removeEventListener('touchmove', drag);
                    document.removeEventListener('mouseup', stopDrag);
                    document.removeEventListener('touchend', stopDrag);
                    
                    const finalRect = element.getBoundingClientRect();
                    const parentRect = interactiveContainer.getBoundingClientRect();
                    const finalCenterY = (finalRect.top - parentRect.top) + finalRect.height / 2;
                    const finalVerticalDistance = Math.abs(finalCenterY - centerY);

                    if (finalVerticalDistance > SNAP_BACK_VERTICAL_RADIUS) {
                        element.classList.add('snapping-back');
                        element.style.left = element.dataset.originalLeft;
                        element.style.top = element.dataset.originalTop;
                        
                        setTimeout(() => {
                            element.classList.remove('snapping-back');
                        }, 400);
                    }
                };

                element.addEventListener('mousedown', startDrag);
                element.addEventListener('touchstart', startDrag);
            });
        }

        // JavaScript untuk mengontrol slideshow
        const slideshowImages = document.querySelectorAll('.hero-slideshow-image');
        let currentImageIndex = 0;

        function changeBackgroundImage() {
            slideshowImages[currentImageIndex].classList.remove('active');
            currentImageIndex = (currentImageIndex + 1) % slideshowImages.length;
            slideshowImages[currentImageIndex].classList.add('active');
        }

        setInterval(changeBackgroundImage, 7000);
    });
    </script>

</body>
</html>