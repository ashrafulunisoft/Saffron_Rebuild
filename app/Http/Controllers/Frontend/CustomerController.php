<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Address;

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

        $order->load(['orderItems.product']);
        return view('frontend.customer.order-show', compact('order'));
    }

    /**
     * Display customer wishlist.
     */
    public function wishlist()
    {
        $wishlist = auth()->user()->wishlist()->with('product.category')->get() ?? collect();
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
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = $request->only('name', 'email', 'phone', 'date_of_birth', 'gender');

        // Update password if provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        auth()->user()->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Store a new address.
     */
    public function storeAddress(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
        ]);

        auth()->user()->addresses()->create([
            'label' => $request->label,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'is_default' => $request->has('is_default'),
        ]);

        return redirect()->back()->with('success', 'Address added successfully!');
    }

    /**
     * Update an existing address.
     */
    public function updateAddress(Request $request, Address $address)
    {
        // Check if address belongs to authenticated user
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'label' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
        ]);

        $address->update([
            'label' => $request->label,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'is_default' => $request->has('is_default'),
        ]);

        return redirect()->back()->with('success', 'Address updated successfully!');
    }

    /**
     * Delete an address.
     */
    public function deleteAddress(Address $address)
    {
        // Check if address belongs to authenticated user
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        $address->delete();

        return redirect()->back()->with('success', 'Address deleted successfully!');
    }

    /**
     * Set address as default.
     */
    public function setDefaultAddress(Address $address)
    {
        // Check if address belongs to authenticated user
        if ($address->user_id !== auth()->id()) {
            abort(403);
        }

        // Remove default from all user's addresses
        auth()->user()->addresses()->update(['is_default' => false]);

        // Set this address as default
        $address->update(['is_default' => true]);

        return redirect()->back()->with('success', 'Default address updated successfully!');
    }
}
