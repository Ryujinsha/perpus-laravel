<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $buku_terbaru = Buku::latest()->take(4)->get();
        return view('home', compact('buku_terbaru'));
    }

    public function katalog(Request $request)
    {
        if ($request->has('search')) {
            $buku = Buku::where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('author', 'like', '%' . $request->search . '%')
                        ->latest()
                        ->paginate(8); 
        } else {
            $buku = Buku::latest()->paginate(8);
        }

        return view('public.katalog', compact('buku'));
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('public.detail', compact('buku'));
    }
}