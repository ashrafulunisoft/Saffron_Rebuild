<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureSessionForPayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('EnsureSessionForPayment middleware', [
            'url' => $request->fullUrl(),
            'auth_check' => Auth::check(),
        ]);

        $response = $next($request);

        // Ensure session is saved if user is authenticated
        if (Auth::check()) {
            session()->save();
            Log::info("Session saved in middleware", [
                'user_id' => Auth::id(),
            ]);
        }

        return $response;
    }
}
