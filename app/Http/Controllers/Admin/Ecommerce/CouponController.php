<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of coupons.
     */
    public function index()
    {
        $coupons = Coupon::withCount('orders')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.ecommerce.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new coupon.
     */
    public function create()
    {
        return view('admin.ecommerce.coupons.create');
    }

    /**
     * Store a newly created coupon in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:100|unique:coupons,code',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date|after:now',
            'usage_limit' => 'nullable|integer|min:1',
        ], [
            'code.required' => 'Coupon code is required.',
            'code.unique' => 'This coupon code already exists.',
            'type.required' => 'Discount type is required.',
            'value.required' => 'Discount value is required.',
            'expires_at.after' => 'Expiration date must be in the future.',
        ]);

        Coupon::create([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'max_discount' => $request->max_discount,
            'expires_at' => $request->expires_at,
            'usage_limit' => $request->usage_limit,
            'usage_count' => 0,
        ]);

        return redirect()
            ->route('admin.ecommerce.coupons.index')
            ->with('success', 'Coupon created successfully! কুপন সফলভাবে তৈরি করা হয়েছে!');
    }

    /**
     * Display the specified coupon.
     */
    public function show(Coupon $coupon)
    {
        $coupon->load('orders');

        return view('admin.ecommerce.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified coupon.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.ecommerce.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified coupon in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|string|max:100|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date|after:now',
            'usage_limit' => 'nullable|integer|min:1',
        ], [
            'code.required' => 'Coupon code is required.',
            'code.unique' => 'This coupon code already exists.',
            'type.required' => 'Discount type is required.',
            'value.required' => 'Discount value is required.',
            'expires_at.after' => 'Expiration date must be in the future.',
        ]);

        $coupon->update([
            'code' => strtoupper($request->code),
            'type' => $request->type,
            'value' => $request->value,
            'max_discount' => $request->max_discount,
            'expires_at' => $request->expires_at,
            'usage_limit' => $request->usage_limit,
        ]);

        return redirect()
            ->route('admin.ecommerce.coupons.index')
            ->with('success', 'Coupon updated successfully! কুপন সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified coupon from storage.
     */
    public function destroy(Coupon $coupon)
    {
        // Check if coupon is being used
        if ($coupon->orders()->count() > 0) {
            return back()->with('error', 'Cannot delete coupon! It has been used in ' . $coupon->orders()->count() . ' order(s).');
        }

        $coupon->delete();

        return redirect()
            ->route('admin.ecommerce.coupons.index')
            ->with('success', 'Coupon deleted successfully! কুপন মুছে ফেলা হয়েছে!');
    }

    /**
     * Toggle coupon active status (via expiration date).
     */
    public function toggleStatus(Coupon $coupon)
    {
        if ($coupon->expires_at && $coupon->expires_at->isFuture()) {
            // Expire the coupon
            $coupon->update(['expires_at' => now()]);
        } elseif ($coupon->expires_at && $coupon->expires_at->isPast()) {
            // Activate the coupon (set to 30 days from now)
            $coupon->update(['expires_at' => now()->addDays(30)]);
        }

        return back()->with('success', 'Coupon status updated successfully!');
    }

    /**
     * Search coupons.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $coupons = Coupon::withCount('orders')
            ->where('code', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.ecommerce.coupons.index', compact('coupons', 'query'));
    }

    /**
     * Get coupon statistics.
     */
    public function statistics()
    {
        $totalCoupons = Coupon::count();
        $activeCoupons = Coupon::where('expires_at', '>', now())->count();
        $expiredCoupons = Coupon::where('expires_at', '<', now())->count();

        $totalUsage = Coupon::sum('usage_count');
        $totalDiscount = Coupon::with('orders')
            ->get()
            ->sum(function ($coupon) {
                return $coupon->orders->sum('discount');
            });

        return response()->json([
            'total' => $totalCoupons,
            'active' => $activeCoupons,
            'expired' => $expiredCoupons,
            'total_usage' => $totalUsage,
            'total_discount' => number_format($totalDiscount, 2),
        ]);
    }
}
