<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckReviewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna terautentikasi dan memiliki role internal_reviewer atau admin
        if (Auth::check() && (Auth::user()->level === 'internal_reviewer' || Auth::user()->level === 'admin')) {
            return $next($request);
        }

        return abort(403, 'Unauthorized access');
    }
}
