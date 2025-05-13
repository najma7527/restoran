<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffDapurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();

        // Memeriksa apakah pengguna login dan memiliki peran
        if (!$user || $user->role !== 'Staff_dapur') {
            // Jika tidak, abort dengan error 403 (Forbidden)
            abort(403, 'Unauthorized action');
        }

        // Jika lolos pengecekan, lanjutkan request ke aplikasi
        return $next($request);
    }
}
