<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Library Point</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-slate-800 text-white hidden md:flex flex-col">
            <div class="p-6 text-2xl font-bold border-b border-slate-700">
                Admin Panel
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-slate-700 {{ request()->routeIs('dashboard') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-home w-6"></i> Dashboard
                </a>
                <a href="{{ route('buku.index') }}" class="block px-4 py-2 rounded hover:bg-slate-700 {{ request()->routeIs('buku.*') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-book w-6"></i> Data Buku
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-slate-700">
                    <i class="fas fa-exchange-alt w-6"></i> Peminjaman
                </a>
                <a href="#" class="block px-4 py-2 rounded hover:bg-slate-700">
                    <i class="fas fa-undo w-6"></i> Pengembalian
                </a>
                <a href="{{ route('petugas.index') }}" class="block px-4 py-2 rounded hover:bg-slate-700 {{ request()->routeIs('petugas.*') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-users w-6"></i> Petugas/User
                </a>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:text-red-300">
                        <i class="fas fa-sign-out-alt w-6"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow p-4 md:hidden flex justify-between items-center">
                <span class="font-bold text-xl">Library Point</span>
                <button class="text-gray-600"><i class="fas fa-bars"></i></button>
            </header>

            <main class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>