<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

   public function gaslogin(Request $request)
        {
            $admin = Admin::where('username', $request->username)
                ->where('password', $request->password)
                ->first();

            if ($admin) {
                session(['admin' => $admin]);
                return redirect('/dashboard');
            }

            return back()->with('error', 'Login gagal');
        }


    public function logout(Request $request)
        {
            Session::flush();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

}
