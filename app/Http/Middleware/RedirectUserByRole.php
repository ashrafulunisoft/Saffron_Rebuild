<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectUserByRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         $user = auth()->user();

        // dd($user);

        // Admin and Staff → Admin Dashboard
        if ($user->hasRole('admin') || $user->hasRole('staff')) {
            return redirect()->route('admin.dashboard');
        }

        // Customer → Customer Dashboard
        if ($user->hasRole('customer')) {
            return redirect()->route('customer.dashboard');
        }

        // Receptionist and Visitor → Visitor Dashboard
        if ($user->hasRole('receptionist') || $user->hasRole('visitor')) {
            return redirect()->route('visitor.dashboard');
        }

        // User has no role → redirect to home with error
        return redirect()->route('home')->with('error', 'You do not have any role assigned. Please contact the administrator.');

        // return $next($request); // this line pass to the the web.php file for next codeing execution
    }
}
