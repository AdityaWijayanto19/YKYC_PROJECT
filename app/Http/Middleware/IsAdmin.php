<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request);
        }

        // Jika user bukan admin, kembalikan ke halaman login
        // Di aplikasi nyata, mungkin lebih baik redirect ke halaman yang sesuai dengan role user
        return redirect('/login')->with('error', 'Anda tidak memiliki hak akses.');
    }
}