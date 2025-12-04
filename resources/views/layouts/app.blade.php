<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIG Desa Tegalsambi') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            overflow: hidden;
            background-color: #f8fafc;
        }

        #app {
            display: flex;
            flex-direction: column; /* Stack Navbar and Content */
            height: 100vh;
            width: 100vw;
        }

        /* Navbar */
        .navbar {
            height: 64px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 2000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }
        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        /* Main Content Container */
        .main-content {
            flex: 1;
            display: flex; /* Row: Sidebar + Map */
            position: relative;
            overflow: hidden;
        }

        /* Sidebar (Adjusted) */
        .sidebar {
            width: 380px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 10px 0 30px rgba(0,0,0,0.08);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); /* Animate all properties including margin */
            animation: slideIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            height: 100%; /* Full height of main-content */
            position: relative; /* Ensure it takes space */
        }
        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        /* Removed Sidebar Header styles as it's now in Navbar */
        
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
        }
        
        /* Custom Scrollbar */
        .sidebar-content::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-content::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-content::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,0.1);
            border-radius: 20px;
        }

        /* Map */
        #map {
            flex: 1;
            height: 100%;
            width: 100%;
            z-index: 1;
        }

        /* Glassmorphism Controls (Zoom etc) */
        .leaflet-bar {
            border: none !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
        }
        .leaflet-bar a {
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(8px);
            color: #1e293b !important;
            border-bottom: 1px solid rgba(0,0,0,0.1) !important;
            width: 36px !important;
            height: 36px !important;
            line-height: 36px !important;
            font-weight: bold;
            transition: all 0.2s;
        }
        .leaflet-bar a:hover {
            background-color: white !important;
            color: #2563eb !important;
        }
        .leaflet-bar a:first-child { border-top-left-radius: 12px !important; border-top-right-radius: 12px !important; }
        .leaflet-bar a:last-child { border-bottom-left-radius: 12px !important; border-bottom-right-radius: 12px !important; border-bottom: none !important; }

        /* Custom Popup */
        .leaflet-popup-content-wrapper {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.6);
            padding: 0;
            overflow: hidden;
        }
        .leaflet-popup-tip {
            background: rgba(255, 255, 255, 0.95);
        }
        .leaflet-popup-content {
            margin: 0;
            line-height: 1.6;
            font-family: 'Outfit', sans-serif;
        }

        /* Utilities */
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 0.6rem 1.2rem; /* Smaller for navbar */
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35);
        }
        
        .layer-control {
            margin-bottom: 2rem;
            background: rgba(255,255,255,0.4);
            border-radius: 16px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,0.5);
        }
        
        /* Toggle Switch */
        .layer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 5px;
            border-bottom: 1px solid rgba(0,0,0,0.03);
        }
        .layer-item:last-child { border-bottom: none; }
        
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }
        .toggle-switch input { 
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        input:checked + .slider {
            background-color: #2563eb;
        }
        input:checked + .slider:before {
            transform: translateX(20px);
        }

        .mb-6 { margin-bottom: 2rem; }
        .mb-3 { margin-bottom: 1rem; }
        .text-sm { font-size: 0.925rem; }
        .font-bold { font-weight: 700; }
        .font-medium { font-weight: 500; }
        .text-gray-500 { color: #64748b; }
        .text-gray-600 { color: #475569; }
        .text-gray-700 { color: #334155; }
        .uppercase { text-transform: uppercase; }
        .tracking-wider { letter-spacing: 0.1em; }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar {
                padding: 0 16px;
            }
            .navbar-brand span {
                display: none; /* Hide text on small screens if needed, or keep it */
            }
            .main-content {
                flex-direction: column;
            }
            .sidebar {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 50vh; /* Occupy bottom half */
                border-right: none;
                border-top: 1px solid rgba(255, 255, 255, 0.4);
                border-radius: 32px 32px 0 0;
                box-shadow: 0 -10px 40px rgba(0,0,0,0.1);
                animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }
            @keyframes slideUp {
                from { transform: translateY(100%); opacity: 0; }
                to { transform: translateY(0); opacity: 1; }
            }
            .sidebar-content {
                padding: 20px 30px;
            }
            .leaflet-control-container .leaflet-bottom {
                bottom: 52vh;
            }
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        .loader {
            width: 48px;
            height: 48px;
            border: 5px solid #FFF;
            border-bottom-color: #2563eb;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }
        @keyframes rotation {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loader-text {
            margin-top: 15px;
            font-weight: 600;
            color: #1e293b;
            letter-spacing: 1px;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { opacity: 0.6; }
            50% { opacity: 1; }
            100% { opacity: 0.6; }
        }
        .loaded #preloader {
            opacity: 0;
            visibility: hidden;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Preloader -->
    <div id="preloader">
        <span class="loader"></span>
        <div class="loader-text">MEMUAT PETA...</div>
    </div>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="navbar-brand">
                <i class="fas fa-map-marked-alt text-blue-600 text-2xl"></i>
                <span>SIG Desa Tegalsambi</span>
            </div>
            <div class="navbar-menu flex items-center space-x-4">
                <a href="{{ route('landing') }}" class="text-slate-600 hover:text-blue-600 font-medium transition-colors mr-4 flex items-center">
                    <i class="fas fa-home mr-2"></i> Beranda
                </a>
                <button onclick="openStatsModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center mr-4">
                    <i class="fas fa-chart-bar mr-2"></i> Statistik Desa
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                    <i class="fas fa-user-cog"></i> <span>Login Admin</span>
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    @stack('scripts')
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.body.classList.add('loaded');
            }, 800); // Slight delay for smooth effect
        });
    </script>
</body>
</html>
