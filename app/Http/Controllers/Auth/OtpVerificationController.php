<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class OtpVerificationController extends Controller
{
    /**
     * Menampilkan form verifikasi OTP.
     */
    public function showForm()
    {
        return view('auth.verify-otp');
    }

    /**
     * Memproses verifikasi OTP.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $userId = Session::get('pending_user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()
                ->route('register.show')
                ->withErrors(['user' => 'Sesi registrasi tidak ditemukan. Silakan daftar ulang.']);
        }

        // OTP default dummy
        $defaultOtp = 123456;

        if ($request->otp == $defaultOtp) {
            $user->is_verified = true;
            $user->otp_code = null;
            $user->save();

            Session::forget('pending_user_id');

            return redirect()
                ->route('login')
                ->with('success', 'Akun berhasil diverifikasi! Silakan login.');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah, silakan coba lagi.']);
    }
}
