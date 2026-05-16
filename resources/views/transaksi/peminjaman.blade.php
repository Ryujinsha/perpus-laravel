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
    <h3 class="font-bold p-4 bg-gray-50 text-gray-700 border-b">Daftar Transaksi Peminjaman</h3>
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4">Member & Kode</th>
                <th class="p-4">Buku</th>
                <th class="p-4">Wajib Kembali</th>
                <th class="p-4">Status</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-4">
                    <strong>{{ $item->user->name }}</strong><br>
                    <span class="text-xs text-gray-500 font-mono">{{ $item->kode_peminjaman }}</span>
                </td>
                <td class="p-4">{{ $item->buku->title ?? '-' }}</td>
                <td class="p-4">
                    @if($item->status == 'pending')
                        <span class="text-gray-400 italic">Menunggu Approval</span>
                    @else
                        <span class="{{ $item->status == 'active' && now() > $item->due_date ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                            {{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}
                        </span>
                    @endif
                </td>
                <td class="p-4">
                    @if($item->status == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-bold uppercase">Booking</span>
                    @elseif($item->status == 'active')
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-bold uppercase">Dipinjam</span>
                    @elseif($item->status == 'returned')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-bold uppercase">Selesai</span>
                    @endif
                </td>
                <td class="p-4 text-center">
                    @if($item->status == 'active')
                        <form action="{{ route('transaksi.kembalikan', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs transition-colors">
                                <i class="fas fa-undo mr-1"></i> Terima Buku
                            </button>
                        </form>
                    @elseif($item->status == 'pending')
                        <span class="text-xs text-gray-400">Gunakan scanner di atas</span>
                    @else
                        <i class="fas fa-check-circle text-green-500" title="Transaksi Selesai"></i>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-gray-400">
                    <i class="fas fa-history text-3xl mb-2 block"></i>
                    Belum ada data peminjaman.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection