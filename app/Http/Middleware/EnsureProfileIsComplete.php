<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->profile_completion_percentage < 100) {

            if (!$request->routeIs('customer.profile.edit')) {
                return redirect()->route('customer.profile.edit')
                    ->with('warning', 'Harap lengkapi profil Anda (minimal 100%) sebelum dapat melanjutkan.');
            }

            return redirect()->route('customer.profile.edit')
                ->with('warning', 'Harap lengkapi profil Anda (minimal 100%) sebelum dapat membuat pesanan.');
        } 

        return $next($request);
    } 
}
