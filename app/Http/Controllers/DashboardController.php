<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Petugas;

class DashboardController extends Controller
{
    public function index()
        {
            $admin = session('admin');

            $totalBuku = Buku::count();
            $totalPetugas = Petugas::count();

            $bukuTerbaru = Buku::latest()->take(5)->get();
            $petugasTerbaru = Petugas::latest()->take(5)->get();

            return view('dashboard.index', compact(
                'admin',
                'totalBuku',
                'totalPetugas',
                'bukuTerbaru',
                'petugasTerbaru'
            ));
        }

}
