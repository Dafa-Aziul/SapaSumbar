<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_wa' => 'required|string|max:20|unique:users,no_wa',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'password' => bcrypt($request->password),
        ]);

        session(['register_email' => $user->email]);

        return redirect()->route('otp.show')->with('info', 'Silakan verifikasi OTP untuk melanjutkan.');
    }
}
