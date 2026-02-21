<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Session;

class BukuController extends Controller
{
    public function index(){
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }
    public function store(Request $r){ 
        buku::create($r->all()); 
        return redirect('/buku'); 
    } 
    public function delete($id){ 
        buku::where('id_buku',$id)->delete(); 
        return redirect('/buku'); 
    } 
    public function edit($id){ 
        $buku = buku::find($id); 
        return view('buku.edit', compact('buku')); 
    } 
    public function update(Request $r, $id){ 
        buku::where('id_buku',$id)->update([ 
            'nama_buku'=>$r->nama_buku, 
            'matkul'=>$r->matkul 
        ]); 
        return redirect('/buku'); 
    } 
    public function search(Request $r){ 
        $keyword = $r->q;
        $buku = buku::where('judul_buku','like','%'.$r->q.'%')->get(); 
        $buku = buku::where('penerbit','like','%'.$r->q.'%')->get();
        $buku = buku::where('tahun_terbit','like','%'.$r->q.'%')->get(); 
        $buku = buku::where('penulis','like','%'.$r->q.'%')->get();
        return view('buku.index', compact('buku')); 
    } 
}
