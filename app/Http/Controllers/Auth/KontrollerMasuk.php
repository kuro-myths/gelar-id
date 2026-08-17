<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrollerMasuk extends Controller
{
    public function tampilFormMasuk()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor');
        }
        return view('auth.masuk');
    }

    public function masuk(Request $request)
    {
        $kredensial = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($kredensial, $request->boolean('ingat'))) {
            $request->session()->regenerate();
            $pengguna = Auth::user();

            if (!$pengguna->is_active) {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun Anda tidak aktif. Hubungi admin.']);
            }

            return redirect()->intended(
                $pengguna->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor'
            );
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ])->onlyInput('email');
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
