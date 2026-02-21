<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Petugas;
use Illuminate\Support\Facades\Session;

class PetugasController extends Controller
{
    public function index(){
        $petugas = petugas::all();
        return view('petugas.index', compact('petugas'));
    }
    public function store(Request $r){ 
        petugas::create($r->all()); 
        return redirect('/petugas'); 
    } 
    public function delete($id){ 
        petugas::where('id_petugas',$id)->delete(); 
        return redirect('/petugas'); 
    } 
    public function edit($id){ 
        $petugas = petugas::find($id); 
        return view('petugas.edit', compact('petugas')); 
    } 
    public function update(Request $r, $id){ 
        petugas::where('id_petugas',$id)->update([ 
            'nama_petugas'=>$r->nama_petugas, 
            'posisi'=>$r->posisi 
        ]); 
        return redirect('/petugas'); 
    } 
    public function search(Request $r)
    {
        $keyword = $r->s;
        $petugas = petugas::where('nama_petugas', 'like', '%' . $keyword . '%')
                        ->orWhere('posisi', 'like', '%' . $keyword . '%')
                        ->get();
        return view('petugas.index', compact('petugas'));
    }
}
