<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek role user, pastikan dia 'user'
        if (Auth::user()->role !== 'user') {
            abort(403, 'Akses ditolak — halaman ini hanya untuk pengguna biasa.');
        }

        // Lanjutkan request
        return $next($request);
    }
}
