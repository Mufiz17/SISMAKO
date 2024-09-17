<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class Password
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $protectedRoutes = [
            'dashboard',
            'penilaian',
            'administrasi',
            'finance',
            'keasramaan',
            'sarpras',
            'jamaah.index',
            'inbox.index',
            'patroli.asrama.index',
            'lab.index',
        ];

        $currentRouteName = Route::currentRouteName();

            if (!in_array($currentRouteName, $protectedRoutes)) {
                $request->session()->forget('pin');
            } else {
                $pin = $request->session()->get('pin');

                if (!$pin) {
                    return redirect()->route('pin')->with('error', 'Please enter your PIN to access this URL.');
                }
            }
            return $next($request);
    }
}
