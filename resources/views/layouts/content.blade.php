<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Tegalsambi') - Portal Resmi</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* Fixed White Navbar Style */
        .content-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        .nav-link {
            color: #475569; /* Slate-600 */
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #2563eb; /* Blue-600 */
        }
        .logo-text { color: #1e293b; }
        .logo-subtext { color: #64748b; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 content-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('landing') }}" class="flex-shrink-0 flex items-center gap-3 decoration-0">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                        <i class="fas fa-landmark text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold leading-none logo-text">Desa Tegalsambi</h1>
                        <p class="text-xs font-medium logo-subtext">Kabupaten Jepara</p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('landing') }}" class="nav-link">Beranda</a>
                    <a href="{{ route('landing') }}#profil" class="nav-link">Profil</a>
                    <a href="{{ route('landing') }}#statistik" class="nav-link">Statistik</a>
                    <a href="{{ route('landing') }}#berita" class="nav-link text-blue-600">Berita</a>
                    <a href="{{ route('landing') }}#galeri" class="nav-link">Galeri</a>
                    <a href="{{ route('landing') }}#kontak" class="nav-link">Kontak</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('map') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition-all shadow-lg shadow-blue-500/30 flex items-center gap-2">
                        <i class="fas fa-map-marked-alt"></i> Peta SIG
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-slate-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="{{ route('landing') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-blue-50">Beranda</a>
                <a href="{{ route('map') }}" class="block px-3 py-2 mt-4 text-center rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/30">
                    Buka Peta SIG
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-24">
        @yield('content')
    </main>

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
                </div>
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
