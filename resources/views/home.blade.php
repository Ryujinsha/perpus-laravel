@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="relative bg-blue-600 rounded-3xl overflow-hidden shadow-xl mb-12">
        <div class="px-8 py-16 md:px-20 md:py-20 text-center md:text-left">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6">
                Jelajahi Dunia Lewat <br> <span class="text-yellow-300">Library Point</span>
            </h1>
            <p class="text-blue-100 text-lg mb-8 max-w-xl">
                Temukan ribuan koleksi buku menarik, dari novel best-seller hingga referensi akademik. Pinjam mudah, wawasan bertambah.
            </p>
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('public.katalog') }}" class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition shadow-lg text-center">
                    Cari Buku Sekarang
                </a>
                @guest
                    <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold hover:bg-white/10 transition text-center">
                        Gabung Member
                    </a>
                @endguest
            </div>
        </div>
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-blue-500 rounded-full opacity-50 blur-3xl"></div>
    </div>

    <div class="flex justify-between items-end mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📚 Koleksi Terbaru</h2>
        <a href="{{ route('public.katalog') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Lihat Semua &rarr;</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
        @foreach($buku_terbaru as $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group">
            <a href="{{ route('public.detail', $item->id) }}">
                <div class="aspect-[2/3] bg-gray-200 overflow-hidden relative">
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                            <span class="text-xs">No Image</span>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2">
                        @if($item->stock > 0)
                            <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-md shadow-sm">Tersedia</span>
                        @else
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md shadow-sm">Habis</span>
                        @endif
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 truncate mb-1" title="{{ $item->title }}">{{ $item->title }}</h3>
                    <p class="text-sm text-gray-500 truncate">{{ $item->author }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection