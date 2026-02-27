@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Peminjaman Buku</h1>
</div>

@if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
@if(session('error')) <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">{{ session('error') }}</div> @endif

<div class="bg-white p-6 rounded-xl shadow-sm mb-8">
    <h3 class="font-bold text-lg mb-2">Serahkan Buku (Scan Kode)</h3>
    <form action="{{ route('transaksi.approve') }}" method="POST" class="flex gap-3">
        @csrf
        <input type="text" name="kode_peminjaman" placeholder="LP..." class="flex-1 px-4 py-2 border rounded-lg uppercase" required>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold">Proses</button>
    </form>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <h3 class="font-bold p-4 bg-green-50 text-green-700">Sedang Dipinjam</h3>
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 border-y">
            <tr>
                <th class="p-4">Member & Kode</th>
                <th class="p-4">Buku</th>
                <th class="p-4">Wajib Kembali</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($berjalan as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-4"><strong>{{ $item->user->name }}</strong><br><span class="text-xs text-gray-500">{{ $item->kode_peminjaman }}</span></td>
                <td class="p-4">{{ $item->buku->title ?? '-' }}</td>
                <td class="p-4 text-red-600 font-bold">{{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}</td>
                <td class="p-4 text-center">
                    <form action="{{ route('transaksi.kembalikan', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Terima Buku</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-4 text-center text-gray-400">Tidak ada peminjaman aktif.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection