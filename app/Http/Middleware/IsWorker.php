<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; 

class IsWorker
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->worker) {
            return $next($request);
        }

        abort(403, 'AKSES DITOLAK. HANYA UNTUK WORKER.');
    }
}