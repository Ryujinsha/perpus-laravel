@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Buku</h1>
    <a href="{{ route('buku.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        <i class="fas fa-plus mr-2"></i> Tambah Buku
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-4 border-b">
        <form action="{{ route('buku.search') }}" method="GET">
            <input type="text" name="search" placeholder="Cari judul atau penulis..." class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </form>
    </div>

    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-sm font-bold text-gray-600 uppercase">Cover</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600 uppercase">Judul</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600 uppercase">Penulis</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600 uppercase">Stok</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($data_buku as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" alt="Cover" class="w-12 h-16 object-cover rounded">
                    @else
                        <span class="text-xs text-gray-400">No Img</span>
                    @endif
                </td>
                <td class="px-6 py-4 font-medium text-gray-800">{{ $item->title }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $item->author }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-bold rounded-full {{ $item->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $item->stock }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex space-x-2">
                        <a href="{{ route('buku.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('buku.delete', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">Belum ada data buku.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="p-4">
        {{ $data_buku->links() }} 
    </div>
</div>
@endsection