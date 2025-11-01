<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterUserController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'no_hp'     => 'required|string|min:10|max:15|unique:users,no_hp',
            'password'  => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Gunakan OTP dummy (bisa ganti ke random jika mau)
        $otp = '123456';

        // Simpan user baru (belum diverifikasi)
        $user = User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'no_hp'       => $request->no_hp,
            'password'    => Hash::make($request->password),
            'otp_code'    => $otp,
            'is_verified' => false,
        ]);

        // Simpan data sementara ke session untuk proses verifikasi OTP
        Session::put('pending_user_id', $user->id);
        Session::put('otp', $otp); // buat jaga-jaga kalau mau dicek dari OtpVerificationController

        // (opsional) tampilkan OTP dummy di log agar developer bisa lihat
        Log::info('OTP Dummy untuk user ' . $user->email . ': ' . $otp);

        // Redirect ke halaman OTP
        return redirect()->route('otp.form')->with('info', "Kode OTP dummy: {$otp}");
    }
}
