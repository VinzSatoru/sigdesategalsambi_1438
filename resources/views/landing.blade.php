<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Desa Tegalsambi</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .hero-bg {
            background-color: #0f172a;
            background-image: url("https://images.unsplash.com/photo-1518182170546-0766bc6f9213?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80");
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Parallax effect */
        }
        .gallery-item {
            overflow: hidden;
            border-radius: 1rem;
            position: relative;
        }
        .gallery-item img {
            transition: transform 0.5s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
        }
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                        <i class="fas fa-landmark text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-800 leading-none">Desa Tegalsambi</h1>
                        <p class="text-xs text-slate-500 font-medium">Kabupaten Jepara</p>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="nav-link text-slate-600 hover:text-blue-600 font-medium transition-colors">Beranda</a>
                    <a href="#profil" class="nav-link text-slate-600 hover:text-blue-600 font-medium transition-colors">Profil</a>
                    <a href="#statistik" class="nav-link text-slate-600 hover:text-blue-600 font-medium transition-colors">Statistik</a>
                    <a href="#berita" class="nav-link text-slate-600 hover:text-blue-600 font-medium transition-colors">Berita</a>
                    <a href="#galeri" class="nav-link text-slate-600 hover:text-blue-600 font-medium transition-colors">Galeri</a>
                    <a href="#kontak" class="nav-link text-slate-600 hover:text-blue-600 font-medium transition-colors">Kontak</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-4 py-2.5 text-slate-700 hover:text-blue-700 font-bold transition-all bg-white border border-slate-200 hover:border-blue-300 hover:bg-blue-50 rounded-xl mr-2 shadow-sm">
                        <i class="fas fa-user-shield mr-2"></i> Admin Login
                    </a>
                    <a href="{{ route('map') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-blue-500/30 flex items-center gap-2">
                        <i class="fas fa-map-marked-alt"></i> Peta SIG
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-slate-600 hover:text-blue-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="#beranda" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">Beranda</a>
                <a href="#profil" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">Profil</a>
                <a href="#statistik" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">Statistik</a>
                <a href="#kontak" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">Kontak</a>
                <a href="{{ route('map') }}" class="block px-3 py-2 mt-4 text-center rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30">
                    Buka Peta SIG
                </a>
                <a href="{{ route('login') }}" class="block px-3 py-2 mt-2 text-center rounded-xl font-bold text-slate-600 hover:bg-slate-100 border border-slate-200">
                    Admin Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Beranda) -->
    <section id="beranda" class="hero-bg relative min-h-screen flex items-center pt-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/80 via-slate-900/60 to-slate-900/90"></div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-blue-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div data-aos="fade-down" data-aos-duration="1000">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-300 text-sm font-semibold mb-6 backdrop-blur-sm">
                    Selamat Datang di Portal Resmi
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 leading-tight" data-aos="fade-up" data-aos-delay="200">
                Desa <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">Tegalsambi</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-300 font-light mb-10 max-w-3xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="400">
                Menuju desa cerdas dengan integrasi teknologi informasi dan pemetaan geografis untuk pelayanan publik yang lebih baik.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('map') }}" class="px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-2xl font-bold text-lg transition-all transform hover:scale-105 shadow-xl shadow-blue-600/40 flex items-center gap-3">
                    <i class="fas fa-map-marked-alt"></i> Jelajahi Peta
                </a>
                <a href="#profil" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white rounded-2xl font-bold text-lg transition-all backdrop-blur-md border border-white/10 flex items-center gap-3">
                    <i class="fas fa-info-circle"></i> Tentang Desa
                </a>
            </div>
        </div>
    </section>

    <!-- Profil Section -->
    <section id="profil" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Profil Desa</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
                <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto">
                    Mengenal lebih dekat Desa Tegalsambi, sejarah, visi, dan misi kami dalam membangun masyarakat yang sejahtera.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-600 rounded-3xl transform rotate-3 opacity-10"></div>
                    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Suasana Desa" class="relative rounded-3xl shadow-2xl w-full object-cover h-[400px]">
                </div>
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-slate-800">Sejarah Singkat</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Desa Tegalsambi memiliki sejarah panjang yang kaya akan budaya dan tradisi. Terletak di Kabupaten Jepara, desa ini dikenal dengan semangat gotong royong warganya dan potensi alam yang melimpah. Kami berkomitmen untuk melestarikan warisan leluhur sambil terus berinovasi mengikuti perkembangan zaman.
                    </p>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8">
                        <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 mb-4">
                                <i class="fas fa-eye text-xl"></i>
                            </div>
                            <h4 class="font-bold text-slate-800 mb-2">Visi</h4>
                            <p class="text-sm text-slate-600">Terwujudnya Desa Tegalsambi yang Maju, Mandiri, dan Sejahtera.</p>
                        </div>
                        <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 mb-4">
                                <i class="fas fa-bullseye text-xl"></i>
                            </div>
                            <h4 class="font-bold text-slate-800 mb-2">Misi</h4>
                            <p class="text-sm text-slate-600">Meningkatkan pelayanan publik dan pemberdayaan ekonomi masyarakat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section id="statistik" class="py-24 bg-slate-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Statistik Desa</h2>
                <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full"></div>
                <p class="mt-4 text-lg text-slate-600">Data terkini kependudukan dan potensi wilayah Desa Tegalsambi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Stat Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-600">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-lg">Penduduk</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($total_population) }}</h3>
                    <p class="text-slate-500 font-medium">Jiwa</p>
                </div>
                <!-- Stat Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">Laki-laki</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($male_population) }}</h3>
                    <p class="text-slate-500 font-medium">Jiwa</p>
                </div>
                <!-- Stat Card 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center text-pink-600">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-pink-600 bg-blue-50 px-2 py-1 rounded-lg">Perempuan</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($female_population) }}</h3>
                    <p class="text-slate-500 font-medium">Jiwa</p>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-600">
                            <i class="fas fa-home text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded-lg">Keluarga</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($total_kk) }}</h3>
                    <p class="text-slate-500 font-medium">Kepala Keluarga</p>
                </div>

                <!-- Stat Card 3 (Area) -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                            <i class="fas fa-ruler-combined text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">Luas Desa</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($area_ha, 2) }}</h3>
                    <p class="text-slate-500 font-medium">Hektar</p>
                </div>

                <!-- Stat Card 4 (POI) -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600">
                            <i class="fas fa-map-marker-alt text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded-lg">Fasilitas</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($total_pois) }}</h3>
                    <p class="text-slate-500 font-medium">Titik Lokasi</p>
                </div>

                <!-- Stat Card 5 (Infrastructure) -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center text-red-600">
                            <i class="fas fa-road text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-lg">Infrastruktur</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($total_infrastructures) }}</h3>
                    <p class="text-slate-500 font-medium">Ruas Jalan</p>
                </div>

                <!-- Stat Card 6 (Land Use) -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-slate-100 hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center text-yellow-600">
                            <i class="fas fa-layer-group text-2xl"></i>
                        </div>
                        <span class="text-xs font-bold text-yellow-600 bg-yellow-50 px-2 py-1 rounded-lg">Lahan</span>
                    </div>
                    <h3 class="text-4xl font-extrabold text-slate-800 mb-1">{{ number_format($total_land_uses) }}</h3>
                    <p class="text-slate-500 font-medium">Bidang Tanah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-6">Hubungi Kami</h2>
                    <p class="text-lg text-slate-600 mb-8">
                        Punya pertanyaan atau butuh bantuan? Jangan ragu untuk menghubungi perangkat desa kami atau datang langsung ke kantor balai desa.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Alamat Kantor</h4>
                                <p class="text-slate-600">Jl. Raya Tegalsambi No. 1, Kec. Tahunan, Kab. Jepara, Jawa Tengah 59427</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 flex-shrink-0">
                                <i class="fas fa-phone-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Telepon</h4>
                                <p class="text-slate-600">(0291) 1234567</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-600 flex-shrink-0">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Email</h4>
                                <p class="text-slate-600">admin@tegalsambi.desa.id</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 p-8 rounded-3xl border border-slate-100">
                    <form>
                        <div class="mb-6">
                            <label class="block text-slate-700 font-bold mb-2">Nama Lengkap</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="Masukkan nama anda">
                        </div>
                        <div class="mb-6">
                            <label class="block text-slate-700 font-bold mb-2">Email</label>
                            <input type="email" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all" placeholder="alamat@email.com">
                        </div>
                        <div class="mb-6">
                            <label class="block text-slate-700 font-bold mb-2">Pesan</label>
                            <textarea class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all h-32" placeholder="Tulis pesan anda disini..."></textarea>
                        </div>
                        <button type="button" class="w-full py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-blue-500/30">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-6 md:mb-0 text-center md:text-left">
                    <h2 class="text-2xl font-bold mb-2">Desa Tegalsambi</h2>
                    <p class="text-slate-400">&copy; {{ date('Y') }} Pemerintah Desa Tegalsambi. All rights reserved.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="fab fa-facebook text-2xl"></i></a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-slate-400 hover:text-white transition-colors"><i class="fab fa-youtube text-2xl"></i></a>
                    <a href="{{ route('login') }}" class="text-slate-400 hover:text-white transition-colors" title="Login Admin"><i class="fas fa-user-shield text-2xl"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true,
            offset: 100,
            duration: 800,
            easing: 'ease-out-cubic',
        });

        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Navbar Scroll Effect & Scroll Spy
        const nav = document.querySelector('nav');
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('section');

        window.addEventListener('scroll', () => {
            // Navbar Style
            if (window.scrollY > 50) {
                nav.classList.add('shadow-md');
                nav.classList.replace('bg-white/80', 'bg-white/95');
            } else {
                nav.classList.remove('shadow-md');
                nav.classList.replace('bg-white/95', 'bg-white/80');
            }

            // Scroll Spy
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-blue-600');
                link.classList.add('text-slate-600');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.remove('text-slate-600');
                    link.classList.add('text-blue-600');
                }
            });
        });
    </script>
</body>
</html>
