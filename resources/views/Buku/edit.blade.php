@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Buku</h1>
            <p class="text-gray-600 mt-1">Perbarui informasi buku: <span class="font-semibold">{{ $buku->title }}</span></p>
        </div>
        <a href="{{ route('buku.index') }}" class="flex items-center text-gray-600 hover:text-blue-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
    </div>2

    <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">Kode Buku</label>
                        <input type="text" name="code" id="code" value="{{ old('code', $buku->code) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none @error('code') border-red-500 @enderror" 
                            placeholder="Contoh: B-001">
                        @error('code')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Buku</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $buku->title) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none @error('title') border-red-500 @enderror" 
                            placeholder="Masukkan judul buku">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">Penulis</label>
                        <input type="text" name="author" id="author" value="{{ old('author', $buku->author) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none @error('author') border-red-500 @enderror" 
                            placeholder="Nama penulis">
                        @error('author')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="publisher" class="block text-sm font-semibold text-gray-700 mb-2">Penerbit</label>
                        <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $buku->publisher) }}" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none @error('publisher') border-red-500 @enderror" 
                            placeholder="Nama penerbit">
                        @error('publisher')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="publication_year" class="block text-sm font-semibold text-gray-700 mb-2">Tahun Terbit</label>
                            <input type="number" name="publication_year" id="publication_year" value="{{ old('publication_year', $buku->publication_year) }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none @error('publication_year') border-red-500 @enderror" 
                                placeholder="2024">
                            @error('publication_year')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $buku->stock) }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none @error('stock') border-red-500 @enderror" 
                                placeholder="0">
                            @error('stock')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="cover_image" class="block text-sm font-semibold text-gray-700 mb-2">Cover Buku</label>
                        <div class="grid grid-cols-1 gap-4">
                            <!-- Current Cover Display -->
                            <div id="current-cover-container" class="relative group {{ $buku->cover_image ? '' : 'hidden' }}">
                                <p class="text-xs text-gray-500 mb-2 italic">Cover Saat Ini:</p>
                                <img id="current-cover" src="{{ $buku->cover_image ? asset('storage/' . $buku->cover_image) : '#' }}" alt="Current Cover" class="w-full h-44 object-contain rounded-xl border border-gray-200 bg-gray-50">
                            </div>

                            <div class="relative group">
                                <label for="cover_image" class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all group-hover:border-blue-400">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                                        <p class="mb-2 text-sm text-gray-500 text-center"><span class="font-semibold">Ganti Cover</span><br>atau seret file ke sini</p>
                                    </div>
                                    <input id="cover_image" name="cover_image" type="file" class="hidden" onchange="previewImage(event)"/>
                                </label>
                            </div>
                            
                            <div id="image-preview-container" class="hidden">
                                <p class="text-xs text-blue-600 mb-2 font-semibold">Preview Cover Baru:</p>
                                <img id="image-preview" src="#" alt="Preview" class="w-full h-44 object-contain rounded-xl border-2 border-blue-200 bg-blue-50">
                            </div>
                        </div>
                        @error('cover_image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="synopsis" class="block text-sm font-semibold text-gray-700 mb-2">Sinopsis</label>
                        <textarea name="synopsis" id="synopsis" rows="3" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none @error('synopsis') border-red-500 @enderror" 
                            placeholder="Ringkasan cerita buku...">{{ old('synopsis', $buku->synopsis) }}</textarea>
                        @error('synopsis')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100 flex justify-end space-x-4">
                <a href="{{ route('buku.index') }}" class="px-6 py-3 rounded-xl border border-gray-200 text-gray-600 font-semibold hover:bg-gray-50 transition-all">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all transform hover:-translate-y-0.5">
                    Update Buku
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('image-preview');
        const container = document.getElementById('image-preview-container');
        const currentContainer = document.getElementById('current-cover-container');
        
        reader.onload = function() {
            if (reader.readyState === 2) {
                preview.src = reader.result;
                container.classList.remove('hidden');
                if (currentContainer) {
                    currentContainer.classList.add('opacity-50');
                }
            }
        }
        
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>
@endsection
