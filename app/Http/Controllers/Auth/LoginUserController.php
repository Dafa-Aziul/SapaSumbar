<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user(); // ambil data user yang login

            // Jika yang login adalah admin, tampilkan pesan peringatan
            if ($user->role === 'admin') {
                Auth::logout(); // logoutkan langsung
                return redirect()->route('login')->withErrors([
                    'email' => 'Halaman ini bukan tempat admin login.',
                ]);
            }

            // Jika role user biasa, arahkan ke dashboard
            if ($user->role === 'user') {
                return redirect()->intended('/home')
                    ->with('success', 'Selamat datang di dashboard!');
            }

            // Jika role tidak dikenali
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Role pengguna tidak dikenali.',
            ]);
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }



    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Berhasil logout.');
    }
}
