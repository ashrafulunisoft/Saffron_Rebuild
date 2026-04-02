<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
     public function show()
    {
        // return "This is the Login page ";
        // return view('auth.login'); // Bootstrap 5
        return view('auth_custom.login'); // this is the full path => /home/ashraful/UniSoft Ltd/VMSUCBL/VMSUCBL/VMSUCBL/vms-ucbl/resources/views/auth_custom/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            // IMPORTANT: Merge cart AND wishlist BEFORE session regeneration to preserve session_id
            \App\Http\Controllers\Frontend\CartController::mergeSessionCart(Auth::id());
            \App\Http\Controllers\Frontend\WishlistController::mergeSessionWishlist(Auth::id());

            $request->session()->regenerate();

            // Check user role and redirect accordingly
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Check if user came from cart or wishlist
            $intendedUrl = $request->session()->get('url.intended');
            if ($intendedUrl && (str_contains($intendedUrl, '/cart') || str_contains($intendedUrl, '/wishlist'))) {
                return redirect()->to($intendedUrl)->with('success', 'Login successful! Your items have been merged.');
            }

            // Redirect customers to profile page
            return redirect()->intended(route('customer.profile'));
        }

        // Return JSON for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Invalid credentials. Please check your email and password.',
                'errors' => ['email' => ['Invalid credentials']]
            ], 422);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
