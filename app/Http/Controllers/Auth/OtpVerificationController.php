<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpVerificationController extends Controller
{
    // Tampilkan form OTP
    public function showForm()
    {
        $email = session('register_email');
        if (!$email) {
            return redirect()->route('register.show')->with('info', 'Silakan daftar terlebih dahulu.');
        }
        return view('auth.verify-otp', compact('email'));
    }

    // Verifikasi OTP
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        // Dummy OTP check
        if ($request->otp == '123456') {
            return redirect()->route('login')->with('info', 'OTP berhasil. Silakan login.');
        }

        return back()->withErrors(['otp' => 'OTP salah, coba lagi.']);
    }
}
