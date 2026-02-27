@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-gray-800">Manajemen Transaksi</h1>

<div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500 mb-8">
    <h3 class="font-bold text-lg mb-4">Serahkan Buku (Aktivasi Peminjaman)</h3>
    <form action="{{ route('transaksi.approve') }}" method="POST" class="flex gap-4">
        @csrf
        <input type="text" name="kode_peminjaman" placeholder="Scan atau Ketik Kode Booking (Contoh: LP27022026...)" class="flex-1 px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 font-mono text-lg uppercase" required autofocus>
        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700">
            Proses Pinjam
        </button>
    </form>
    <p class="text-xs text-gray-500 mt-2">*Masukkan kode dari user. Stok buku akan otomatis dikurangi setelah diproses.</p>
</div>

<h3 class="font-bold text-lg mb-3 text-yellow-600">Booking Menunggu Diambil (Pending)</h3>
<div class="bg-white rounded-lg shadow overflow-hidden mb-8">
    <table class="w-full text-left border-collapse">
        <thead class="bg-yellow-50">
            <tr>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Kode</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Peminjam</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Buku</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Tgl Booking</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pending as $item)
            <tr class="border-t">
                <td class="px-6 py-4 font-mono font-bold text-blue-600">{{ $item->kode_peminjaman }}</td>
                <td class="px-6 py-4">{{ $item->user->name }}</td>
                <td class="px-6 py-4">{{ $item->buku->title }}</td>
                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->loan_date)->format('d M Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada booking pending.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<h3 class="font-bold text-lg mb-3 text-green-600">Buku Sedang Dipinjam (Active)</h3>
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-green-50">
            <tr>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Kode</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Peminjam</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Buku</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Wajib Kembali</th>
                <th class="px-6 py-3 text-sm font-bold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($active as $item)
            <tr class="border-t">
                <td class="px-6 py-4 font-mono text-sm">{{ $item->kode_peminjaman }}</td>
                <td class="px-6 py-4">{{ $item->user->name }}</td>
                <td class="px-6 py-4">{{ $item->buku->title }}</td>
                <td class="px-6 py-4 text-red-600 font-semibold">{{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <form action="{{ route('transaksi.return', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Buku sudah diterima kembali?')" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600 text-sm font-bold">
                            Tandai Kembali
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada buku yang sedang dipinjam.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection