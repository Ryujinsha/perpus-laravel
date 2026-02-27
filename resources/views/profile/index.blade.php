@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.main')

@section('title', 'Profil & Riwayat')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
    
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 mb-8">
        <div class="h-32 bg-gradient-to-r from-blue-600 to-indigo-700"></div>
        <div class="px-8 pb-8 relative">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-4xl shadow-md border-4 border-white -mt-12 mb-4 text-blue-600 font-bold uppercase">
                {{ substr($user->name, 0, 1) }}
            </div>
            
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                    <p class="text-gray-500">{{ $user->email }}</p>
                    <div class="mt-2">
                        @if($user->role === 'admin')
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Administrator</span>
                        @else
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Member Perpustakaan</span>
                        @endif
                    </div>
                </div>
                <button class="bg-gray-100 text-gray-600 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm font-semibold transition">
                    <i class="fas fa-edit mr-1"></i> Edit Profil
                </button>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div>
                    <h3 class="text-gray-500 font-semibold mb-1">Nomor Telepon</h3>
                    <p class="text-gray-800 font-medium text-lg">{{ $user->phone ?? 'Belum diisi' }}</p>
                </div>
                <div>
                    <h3 class="text-gray-500 font-semibold mb-1">Terdaftar Sejak</h3>
                    <p class="text-gray-800 font-medium">{{ $user->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        Riwayat Peminjaman Buku
    </h2>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        @if(count($riwayat_peminjaman) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold text-gray-600">Kode Booking</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-600">Buku</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-600">Tanggal</th>
                            <th class="px-6 py-4 text-sm font-bold text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($riwayat_peminjaman as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <span class="font-mono font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border border-blue-100" id="kode-{{ $item->id }}">
                                        {{ $item->kode_peminjaman }}
                                    </span>
                                    <button onclick="copyToClipboard('{{ $item->kode_peminjaman }}', 'btn-copy-{{ $item->id }}')" id="btn-copy-{{ $item->id }}" class="text-gray-400 hover:text-blue-600 transition" title="Salin Kode">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    </button>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800 line-clamp-1">{{ $item->book->title ?? 'Buku Dihapus' }}</p>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                <span class="block">Pinjam: <strong class="text-gray-800">{{ \Carbon\Carbon::parse($item->loan_date)->format('d M Y') }}</strong></span>
                                <span class="block text-red-500">Kembali: <strong>{{ \Carbon\Carbon::parse($item->due_date)->format('d M Y') }}</strong></span>
                            </td>

                            <td class="px-6 py-4">
                                @if($item->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">
                                        ⏳ Menunggu Diambil
                                    </span>
                                @elseif($item->status == 'active')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                        📖 Sedang Dipinjam
                                    </span>
                                @elseif($item->status == 'returned')
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">
                                        ✅ Dikembalikan
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold border border-red-200">
                                        ⚠️ Terlambat
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Belum Ada Peminjaman</h3>
                <p class="text-gray-500 mt-2">Anda belum pernah meminjam atau mem-booking buku.</p>
                <a href="{{ route('public.katalog') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition">Mulai Cari Buku</a>
            </div>
        @endif
    </div>
</div>

<div id="copyToast" class="fixed bottom-5 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-full shadow-lg transition-all duration-300 opacity-0 translate-y-10 pointer-events-none z-50 flex items-center">
    <svg class="w-5 h-5 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    <span class="font-medium text-sm">Kode berhasil disalin!</span>
</div>

<script>
    function copyToClipboard(text, buttonId) {
        navigator.clipboard.writeText(text).then(function() {
            
            const toast = document.getElementById('copyToast');
            toast.classList.remove('opacity-0', 'translate-y-10');
            
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-10');
            }, 2500);

            const btn = document.getElementById(buttonId);
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            setTimeout(() => {
                btn.innerHTML = originalHTML;
            }, 2500);
            
        }).catch(function(err) {
            console.error('Gagal menyalin: ', err);
            alert('Gagal menyalin kode. Silakan block dan copy manual.');
        });
    }
</script>
@endsection