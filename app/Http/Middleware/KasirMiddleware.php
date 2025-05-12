<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KasirMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa apakah pengguna login dan memiliki peran 'kasir'
        if (!$user || $user->role !== 'kasir') {
            // Jika tidak, abort dengan error 403 (Forbidden)
            abort(403, 'Unauthorized action');
        }

        // Jika lolos pengecekan, lanjutkan request ke aplikasi
        return $next($request);
    }
}
