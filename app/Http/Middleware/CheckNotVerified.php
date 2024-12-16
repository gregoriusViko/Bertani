<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('farmer')->check() ? Auth::guard('farmer')->user() : Auth::guard('buyer')->user();
        if ($user->hasVerifiedEmail()) {
            // Jika pengguna sudah terverifikasi, alihkan ke halaman yang diinginkan
            return redirect('/');
        }

        return $next($request);
    }
}
