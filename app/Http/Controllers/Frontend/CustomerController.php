<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display customer dashboard.
     */
    public function dashboard()
    {
        $user = auth()->user();
        $orders = $user->orders()->latest()->limit(5)->get();

        return view('frontend.customer.dashboard', compact('user', 'orders'));
    }

    /**
     * Display customer orders.
     */
    public function orders()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('frontend.customer.orders', compact('orders'));
    }

    /**
     * Display specific order details.
     */
    public function orderShow(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items.product', 'shippingAddress']);
        return view('frontend.customer.order-show', compact('order'));
    }

    /**
     * Display customer wishlist.
     */
    public function wishlist()
    {
        $wishlist = auth()->user()->wishlist ?? collect();
        return view('frontend.customer.wishlist', compact('wishlist'));
    }

    /**
     * Display customer addresses.
     */
    public function addresses()
    {
        $addresses = auth()->user()->addresses ?? collect();
        return view('frontend.customer.addresses', compact('addresses'));
    }

    /**
     * Display customer profile.
     */
    public function profile()
    {
        return view('frontend.customer.profile');
    }

    /**
     * Update customer profile.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);

        auth()->user()->update($request->only('name', 'email', 'phone'));

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
