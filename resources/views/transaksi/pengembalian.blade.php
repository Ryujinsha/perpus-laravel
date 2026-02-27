@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Riwayat Pengembalian</h1>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4">Kode</th>
                <th class="p-4">Member</th>
                <th class="p-4">Buku</th>
                <th class="p-4">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($selesai as $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-4 font-mono text-xs">{{ $item->kode_peminjaman }}</td>
                <td class="p-4">{{ $item->user->name }}</td>
                <td class="p-4">{{ $item->buku->title ?? '-' }}</td>
                <td class="p-4"><span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs font-bold">Selesai</span></td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-4 text-center text-gray-400">Belum ada riwayat pengembalian.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection