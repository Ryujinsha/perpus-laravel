<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login'); 
    }
    public function gaslogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 👇 HAPUS BARIS INI (dd-nya dihapus)
            // dd(Auth::user()->role); 

            // Logika Redirect yang Benar
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->route('home'); // Member ke Home
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}