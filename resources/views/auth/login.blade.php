<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIG Desa Tegalsambi</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md transform transition-all hover:scale-[1.01]">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Selamat Datang</h1>
            <p class="text-slate-500 mt-2">Silahkan login untuk masuk ke panel admin</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email Address</label>
                <input type="email" name="email" id="email" required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
                    placeholder="admin@tegalsambi.desa.id">
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input type="password" name="password" id="password" required 
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all"
                    placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors shadow-lg shadow-blue-500/30">
                Sign In
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ url('/peta') }}" class="text-sm text-slate-400 hover:text-slate-600 transition-colors">
                &larr; Kembali ke Peta Utama
            </a>
        </div>
    </div>
</body>
</html>
