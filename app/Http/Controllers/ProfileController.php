<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $riwayat_peminjaman = Peminjaman::with('buku')
                                ->where('user_id', $user->id)
                                ->latest()
                                ->get();
        
        return view('profile.index', compact('user', 'riwayat_peminjaman'));
    }
}