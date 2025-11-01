<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class OtpController extends Controller
{
    public function showOtpForm(Request $request)
    {
        $no_wa = $request->no_wa;
        return view('auth.otp', compact('no_wa'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'no_wa' => 'required',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('no_wa', $request->no_wa)->first();

        if ($user && $user->otp == $request->otp) {
            $user->update([
                'is_verified' => true,
                'otp' => null,
            ]);

            return redirect()->route('login')->with('success', 'Verifikasi berhasil! Silakan login.');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kadaluarsa.']);
    }
}
