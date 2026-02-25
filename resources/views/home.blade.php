@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center py-16 bg-blue-600 rounded-2xl text-white mb-10 shadow-lg">
        <h1 class="text-4xl font-extrabold mb-4">Selamat Datang di Library Point</h1>
        <p class="text-lg mb-8 text-blue-100">Temukan ribuan buku menarik dan perluas wawasanmu hari ini.</p>
        <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition">Mulai Membaca</a>
    </div>

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Koleksi Terbaru</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
            <div class="h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                <span>No Image</span>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-lg mb-1 truncate">Filosofi Teras</h3>
                <p class="text-sm text-gray-500 mb-2">Henry Manampiring</p>
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Tersedia</span>
            </div>
        </div>
        </div>
</div>
<div class="mt-16">
    <div class="bg-white rounded-2xl shadow-lg p-10 text-center">

        <h2 class="text-3xl font-bold text-gray-800 mb-4">
            Perluas Wawasanmu Hari Ini
        </h2>

        <p class="text-gray-600 max-w-2xl mx-auto mb-8">
            Membaca adalah investasi terbaik untuk masa depan. 
            Temukan buku favoritmu dan mulai perjalanan literasi 
            bersama Library Point sekarang juga.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}"
               class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">
                Mulai Sekarang
            </a>

            <a href="#koleksi"
               class="border border-blue-600 text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-50 transition">
                Lihat Koleksi
            </a>
        </div>

    </div>
</div>
@endsection
