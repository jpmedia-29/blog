<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah user sudah login dan memiliki role 'admin'
        if (auth()->check() && auth()->user()->role == 'admin') {
            return $next($request); // Jika ya, lanjutkan ke rute berikutnya
        }

        // Jika tidak memiliki akses, arahkan ke halaman login atau halaman lain
        return redirect()->route('login')->with('error', 'You do not have admin access.');
    }
}
