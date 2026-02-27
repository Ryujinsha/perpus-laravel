<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $berjalan = Peminjaman::with(['user', 'buku'])->where('status', 'active')->latest()->get();
        $selesai = Peminjaman::with(['user', 'buku'])->where('status', 'returned')->latest()->get();
        
        return view('transaksi.index', compact('berjalan', 'selesai'));
    }

    public function peminjaman()
    {
        $pending = Peminjaman::with(['user', 'buku'])->where('status', 'pending')->latest()->get();
        $berjalan = Peminjaman::with(['user', 'buku'])->where('status', 'active')->latest()->get();
        
        return view('transaksi.peminjaman', compact('pending', 'berjalan'));
    }

    public function pengembalian()
    {
        $selesai = Peminjaman::with(['user', 'buku'])->where('status', 'returned')->latest()->get();
        
        return view('transaksi.pengembalian', compact('selesai'));
    }

    public function approve(Request $request)
    {
        $request->validate(['kode_peminjaman' => 'required']);

        $peminjaman = Peminjaman::where('kode_peminjaman', $request->kode_peminjaman)
                                ->where('status', 'pending')
                                ->first();

        if (!$peminjaman) {
            return back()->with('error', 'Kode tidak ditemukan atau sudah diproses!');
        }

        $buku = $peminjaman->buku;
        if($buku->stock < 1) {
            return back()->with('error', 'Stok fisik buku ternyata kosong!');
        }
        $buku->decrement('stock');

        $durasiBooking = \Carbon\Carbon::parse($peminjaman->loan_date)->diffInDays(\Carbon\Carbon::parse($peminjaman->due_date));
        
        if ($durasiBooking < 1) $durasiBooking = 1; 
        
        $peminjaman->update([
            'status' => 'active',
            'loan_date' => now(), 
            'due_date' => now()->addDays($durasiBooking) 
        ]);

        return back()->with('success', 'Buku berhasil diserahkan! Timer berjalan.');
    }

    public function returnBook($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if($peminjaman->status === 'active') {
            $peminjaman->update(['status' => 'returned']);
            
            $peminjaman->buku->increment('stock');

            return back()->with('success', 'Buku telah dikembalikan dan stok bertambah.');
        }

        return back()->with('error', 'Status peminjaman tidak valid.');
    }
}