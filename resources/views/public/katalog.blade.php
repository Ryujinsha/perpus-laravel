@extends('layouts.main')

@section('title', 'Katalog Buku')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl font-bold text-gray-800">Katalog Buku</h1>
        <form action="{{ route('public.katalog') }}" method="GET" class="w-full md:w-1/3">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..." class="w-full pl-10 pr-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <span class="absolute left-3 top-2.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </span>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
        @forelse($buku as $item)
        <div class="bg-white rounded-lg shadow-sm border hover:shadow-lg transition">
            <a href="{{ route('public.detail', $item->id) }}">
                <div class="aspect-[2/3] bg-gray-100 overflow-hidden rounded-t-lg relative">
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">No Image</div>
                    @endif
                </div>
                <div class="p-3">
                    <h3 class="font-bold text-gray-800 text-sm truncate">{{ $item->title }}</h3>
                    <p class="text-xs text-gray-500 truncate">{{ $item->author }}</p>
                    <div class="mt-2 text-right">
                         <span class="text-xs font-semibold {{ $item->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $item->stock > 0 ? 'Stok: ' . $item->stock : 'Stok Habis' }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <p class="text-gray-500 text-lg">Buku tidak ditemukan.</p>
            <a href="{{ route('public.katalog') }}" class="text-blue-600 hover:underline">Reset Pencarian</a>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $buku->links() }}
    </div>

</div>
@endsection