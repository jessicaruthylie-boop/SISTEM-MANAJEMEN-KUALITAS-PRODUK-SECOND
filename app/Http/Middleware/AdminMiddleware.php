<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya izinkan jika login DAN role adalah admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika user biasa mencoba masuk ke /admin, lempar balik ke dashboard user
        return redirect('/dashboard')->with('error', 'Akses ditolak. Anda bukan Administrator.');
    }
}