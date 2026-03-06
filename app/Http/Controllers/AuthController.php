<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->password === env('ADMIN_PASSWORD')) {
            session(['admin' => true]);
            return redirect()->route('projects.create');
        }
        return back()->withErrors(['password' => 'Mot de passe incorrect']);
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('projects.index');
    }
}
