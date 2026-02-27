@extends('layouts.main')

@section('title', $buku->title)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
        <div class="md:flex">
            <div class="md:w-1/3 bg-gray-50 p-8 flex justify-center items-start">
                <div class="w-48 shadow-2xl rounded-lg overflow-hidden rotate-1 hover:rotate-0 transition duration-500">
                    @if($buku->cover_image)
                        <img src="{{ asset('storage/' . $buku->cover_image) }}" class="w-full h-auto object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center text-gray-400">No Cover</div>
                    @endif
                </div>
            </div>

            <div class="md:w-2/3 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $buku->title }}</h1>
                        <p class="text-lg text-gray-600 font-medium">{{ $buku->author }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-bold {{ $buku->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $buku->stock > 0 ? 'Tersedia' : 'Habis' }}
                    </span>
                </div>

                <div class="mt-6 border-t border-gray-100 pt-6 space-y-3 text-sm text-gray-600">
                    <div class="flex">
                        <span class="w-32 font-semibold">Kode Buku</span>
                        <span>: {{ $buku->code }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold">Penerbit</span>
                        <span>: {{ $buku->publisher ?? '-' }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold">Tahun Terbit</span>
                        <span>: {{ $buku->publication_year }}</span>
                    </div>
                    <div class="flex">
                        <span class="w-32 font-semibold">Sisa Stok</span>
                        <span>: {{ $buku->stock }} Eksemplar</span>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="font-bold text-gray-900 mb-2">Sinopsis</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $buku->synopsis ?? 'Tidak ada sinopsis untuk buku ini.' }}
                    </p>
                </div>

                <div class="mt-8">
                    @auth
                        @if(Auth::user()->role == 'member')
                            @if($buku->stock > 0)
                                <button onclick="openModal()" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition w-full md:w-auto shadow-lg shadow-blue-500/30">
                                    📖 Ajukan Peminjaman
                                </button>
                                <p class="text-xs text-gray-500 mt-2">*Datang ke perpustakaan untuk mengambil buku.</p>
                            @else
                                <button disabled class="bg-gray-300 text-gray-500 px-8 py-3 rounded-lg font-bold w-full md:w-auto cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        @else
                            <a href="{{ route('dashboard') }}" class="inline-block bg-gray-800 text-white px-6 py-3 rounded-lg font-bold">
                                Ke Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-bold hover:bg-blue-700 transition w-full md:w-auto">
                            Login untuk Meminjam
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</div>
</div> <div id="loanModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center z-50 transition-opacity opacity-0">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 transform scale-95 transition-transform duration-300" id="modalContent">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Formulir Peminjaman</h3>
                
                <form id="loanForm">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                        <input type="text" value="{{ date('d F Y') }}" disabled class="w-full px-4 py-2 bg-gray-100 border rounded-lg text-gray-500">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rencana Kembali</label>
                        <input type="date" name="return_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg font-medium">Batal</button>
                        <button type="submit" id="btnSubmit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 flex items-center">
                            <span id="btnText">Konfirmasi</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="toast" class="fixed bottom-5 right-5 bg-white border-l-4 p-4 rounded shadow-xl hidden transform translate-y-10 transition-all duration-300 z-50 flex items-center max-w-sm">
        <div id="toastIcon" class="mr-3"></div>
        <div>
            <h4 id="toastTitle" class="font-bold text-sm"></h4>
            <p id="toastMessage" class="text-sm text-gray-600"></p>
        </div>
    </div>

    <script>
    const modal = document.getElementById('loanModal');
    const modalContent = document.getElementById('modalContent');
    const form = document.getElementById('loanForm');
    
    function openModal() {
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function showToast(status, message) {
        const toast = document.getElementById('toast');
        const title = document.getElementById('toastTitle');
        const msg = document.getElementById('toastMessage');

        toast.className = "fixed bottom-5 right-5 bg-white border-l-4 p-4 rounded shadow-xl transform transition-all duration-300 z-50 flex items-center max-w-sm";

        if (status === 'success') {
            toast.classList.add('border-green-500');
            title.innerText = "Berhasil!";
            title.classList.add('text-green-600');
        } else {
            toast.classList.add('border-red-500');
            title.innerText = "Gagal!";
            title.classList.add('text-red-600');
        }

        msg.innerText = message;
        toast.classList.remove('hidden', 'translate-y-10');
        
        setTimeout(() => {
            toast.classList.add('translate-y-10');
            setTimeout(() => toast.classList.add('hidden'), 300);
        }, 4000);
    }


    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        const btnSubmit = document.getElementById('btnSubmit');
        const btnText = document.getElementById('btnText');
        
        btnSubmit.disabled = true;
        btnText.innerText = 'Memproses...';

        try {
            const formData = new FormData(form);

            formData.set('buku_id', '{{ $buku->id }}');

            const response = await fetch("{{ route('peminjaman.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                let errorMsg = data.message;
                if (data.errors) {
                    errorMsg = Object.values(data.errors)[0][0]; 
                }
                showToast('error', errorMsg || 'Data tidak lengkap/valid.');
                return; 
            }

            if (data.status === 'success') {
                closeModal();
                showToast('success', data.message);
                form.reset();
            } else {
                showToast('error', data.message);
            }
            
        } catch (error) {
            console.error(error);
            showToast('error', 'Gagal menghubungi server.');
        } finally {
            btnSubmit.disabled = false;
            btnText.innerText = 'Konfirmasi';
        }
    });
</script>
@endsection