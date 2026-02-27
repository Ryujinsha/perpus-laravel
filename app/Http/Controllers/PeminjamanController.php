<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
        public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'return_date' => 'required|date|after:today', 
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        
        if ($buku->stock < 1) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Maaf, stok fisik buku sedang kosong!'
            ], 400);
        }

        $isPendingOrActive = Peminjaman::where('user_id', Auth::id())
            ->where('buku_id', $buku->id) 
            ->whereIn('status', ['pending', 'active'])
            ->exists();

        if ($isPendingOrActive) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Anda sudah meminjam atau mem-booking buku ini.'
            ], 400);
        }

        $tglPinjamFormat = date('dmY'); 
        $tglKembaliFormat = date('dmY', strtotime($request->return_date));
        $randomStr = rand(100, 999);
        
        $kode_peminjaman = "LP" . $tglPinjamFormat . $tglKembaliFormat . $randomStr;

        Peminjaman::create([
            'kode_peminjaman' => $kode_peminjaman, 
            'user_id' => Auth::id(),
            'buku_id' => $buku->id, 
            'loan_date' => now(), 
            'due_date' => $request->return_date, 
            'status' => 'pending' 
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking berhasil! Tunjukkan kode ' . $kode_peminjaman . ' ke petugas perpustakaan.'
        ]);
    }
}