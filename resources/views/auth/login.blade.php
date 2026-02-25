@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-[60vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Masuk Akun</h2>

        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                Login Sekarang
            </button>
        </form>
    </div>
</div>
@endsection