<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku; 
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count(); 
        $totalPetugas = User::where('role', 'admin')->count();

        return view('dashboard.index', compact('totalBuku', 'totalPetugas'));
    }
}