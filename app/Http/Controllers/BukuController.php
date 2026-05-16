<?php

namespace App\Http\Controllers;

use App\Models\Buku; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;
        
        $data_buku = Buku::when($keyword, function($query) use ($keyword) {
            $query->where('title', 'like', "%" . $keyword . "%")
                  ->orWhere('author', 'like', "%" . $keyword . "%")
                  ->orWhere('code', 'like', "%" . $keyword . "%");
        })->latest()->paginate(10);
        
        return view('Buku.index', compact('data_buku'));
    }

    public function create()
    {
        return view('Buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'             => 'required|unique:buku,code', 
            'title'            => 'required',
            'author'           => 'required',
            'publisher'        => 'nullable|string',
            'publication_year' => 'required|numeric',
            'stock'            => 'required|numeric',
            'synopsis'         => 'nullable|string',
            'cover_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('buku_images', 'public');
            $validated['cover_image'] = $path;
        }

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('Buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'code'             => 'required|unique:buku,code,'.$buku->id, 
            'title'            => 'required',
            'author'           => 'required',
            'publisher'        => 'nullable|string',
            'publication_year' => 'required|numeric',
            'stock'            => 'required|numeric',
            'synopsis'         => 'nullable|string',
            'cover_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($buku->cover_image) {
                Storage::disk('public')->delete($buku->cover_image);
            }
            $path = $request->file('cover_image')->store('buku_images', 'public');
            $validated['cover_image'] = $path;
        }

        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    public function delete($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->cover_image) {
            Storage::disk('public')->delete($buku->cover_image);
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }
}