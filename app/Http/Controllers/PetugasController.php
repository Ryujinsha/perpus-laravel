<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('petugas.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,member',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('petugas.index')->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('petugas.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,member',
            'password' => 'nullable|min:6', 
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']); 
        }

        $user->update($validated);

        return redirect()->route('petugas.index')->with('success', 'Data petugas diperbarui!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        
        if (auth()->id() == $user->id) {
             return back()->with('error', 'Tidak bisa menghapus akun yang sedang digunakan!');
        }

        $user->delete();
        return redirect()->route('petugas.index')->with('success', 'Petugas dihapus!');
    }
}