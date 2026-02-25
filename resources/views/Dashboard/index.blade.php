@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-gray-800">Dashboard Overview</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Total Buku</p>
                <h2 class="text-3xl font-bold">{{ $totalBuku ?? 0 }}</h2>
            </div>
            <i class="fas fa-book text-3xl text-blue-200"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Petugas & User</p>
                <h2 class="text-3xl font-bold">{{ $totalPetugas ?? 0 }}</h2>
            </div>
            <i class="fas fa-users text-3xl text-green-200"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-yellow-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Peminjaman Aktif</p>
                <h2 class="text-3xl font-bold">0</h2> </div>
            <i class="fas fa-clock text-3xl text-yellow-200"></i>
        </div>
    </div>
</div>
@endsection