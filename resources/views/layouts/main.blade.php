<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Point - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600">📚 Library Point</a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 font-medium">Beranda</a>
                    <a href="{{ route('public.katalog') }}" class="text-gray-600 hover:text-blue-600 font-medium">Koleksi Buku</a>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="text-blue-600 font-bold bg-blue-50 px-3 py-1 rounded">Dashboard Admin</a>
                        @endif

                        <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-blue-600 font-medium flex items-center">
                            <i class="fas fa-user-circle text-xl mr-1"></i> Profil Saya
                        </a>

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg font-bold hover:bg-blue-700 transition">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-auto py-6 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Library Point. All rights reserved.
    </footer>

</body>
</html>