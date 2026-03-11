<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\B2BCustomer;
use App\Models\User;
use Illuminate\Http\Request;

class B2BController extends Controller
{
    /**
     * Display a listing of B2B customers.
     */
    public function index(Request $request)
    {
        $query = B2BCustomer::with('user', 'approver')
            ->withCount('orders')
            ->orderBy('created_at', 'desc');

        // Search by company name or email
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                    ->orWhere('contact_email', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by approval status
        if ($request->has('status') && $request->get('status') !== 'all') {
            $query->where('approval_status', $request->get('status'));
        }

        // Filter by business type
        if ($request->has('business_type') && $request->get('business_type') !== 'all') {
            $query->where('business_type', $request->get('business_type'));
        }

        $b2bCustomers = $query->paginate(20);

        // Get statistics
        $totalB2BCustomers = B2BCustomer::count();
        $pendingApprovals = B2BCustomer::pending()->count();
        $approvedCustomers = B2BCustomer::approved()->count();
        $rejectedCustomers = B2BCustomer::rejected()->count();
        $activeCustomers = B2BCustomer::approved()->active()->count();

        return view('admin.ecommerce.b2b.index', compact(
            'b2bCustomers',
            'totalB2BCustomers',
            'pendingApprovals',
            'approvedCustomers',
            'rejectedCustomers',
            'activeCustomers'
        ));
    }

    /**
     * Show the form for creating a new B2B customer.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.ecommerce.b2b.create', compact('users'));
    }

    /**
     * Store a newly created B2B customer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:b2_b_customers,user_id',
            'company_name' => 'required|string|max:255',
            'trade_license_number' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'business_type' => 'required|in:retailer,wholesaler,distributor,manufacturer,reseller',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'billing_address' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'credit_limit' => 'required|numeric|min:0',
            'payment_terms' => 'required|in:cash_on_delivery,net_15,net_30,net_60,net_90',
            'payment_days' => 'required|integer|min:0|max:365',
            'pricing_tier' => 'required|in:standard,silver,gold,platinum',
            'wholesale_discount' => 'required|numeric|min:0|max:100',
            'approval_status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string',
        ]);

        $b2bCustomer = B2BCustomer::create($validated);

        // If auto-approved, set approved_at and approved_by
        if ($validated['approval_status'] === 'approved') {
            $b2bCustomer->update([
                'approved_at' => now(),
                'approved_by' => auth()->id(),
            ]);
        }

        return redirect()
            ->route('admin.ecommerce.b2b.show', $b2bCustomer)
            ->with('success', 'B2B customer created successfully!');
    }

    /**
     * Display the specified B2B customer.
     */
    public function show(B2BCustomer $b2b)
    {
        $b2b->load(['user', 'approver', 'orders' => function ($query) {
            $query->latest()->limit(10);
        }]);

        // Calculate statistics
        $totalOrders = $b2b->orders()->count();
        $totalPurchase = $b2b->orders()->where('status', '!=', 'cancelled')->sum('final_amount');
        $pendingOrders = $b2b->orders()->where('status', 'pending')->count();
        $completedOrders = $b2b->orders()->where('status', 'delivered')->count();
        $averageOrderValue = $b2b->orders()->where('status', '!=', 'cancelled')->avg('final_amount') ?? 0;

        return view('admin.ecommerce.b2b.show', compact(
            'b2b',
            'totalOrders',
            'totalPurchase',
            'pendingOrders',
            'completedOrders',
            'averageOrderValue'
        ));
    }

    /**
     * Show the form for editing the specified B2B customer.
     */
    public function edit(B2BCustomer $b2b)
    {
        $users = User::orderBy('name')->get();
        return view('admin.ecommerce.b2b.edit', compact('b2b', 'users'));
    }

    /**
     * Update the specified B2B customer.
     */
    public function update(Request $request, B2BCustomer $b2b)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'trade_license_number' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'business_type' => 'required|in:retailer,wholesaler,distributor,manufacturer,reseller',
            'contact_person' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'billing_address' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'credit_limit' => 'required|numeric|min:0',
            'payment_terms' => 'required|in:cash_on_delivery,net_15,net_30,net_60,net_90',
            'payment_days' => 'required|integer|min:0|max:365',
            'pricing_tier' => 'required|in:standard,silver,gold,platinum',
            'wholesale_discount' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $b2b->update($validated);

        return redirect()
            ->route('admin.ecommerce.b2b.show', $b2b)
            ->with('success', 'B2B customer updated successfully!');
    }

    /**
     * Approve B2B customer application.
     */
    public function approve(B2BCustomer $b2b)
    {
        $b2b->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.ecommerce.b2b.show', $b2b)
            ->with('success', 'B2B customer approved successfully!');
    }

    /**
     * Reject B2B customer application.
     */
    public function reject(Request $request, B2BCustomer $b2b)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $b2b->update([
            'approval_status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return redirect()
            ->route('admin.ecommerce.b2b.show', $b2b)
            ->with('success', 'B2B customer application rejected.');
    }

    /**
     * Remove the specified B2B customer.
     */
    public function destroy(B2BCustomer $b2b)
    {
        // Check if customer has orders
        if ($b2b->orders()->count() > 0) {
            return redirect()
                ->route('admin.ecommerce.b2b.show', $b2b)
                ->with('error', 'Cannot delete B2B customer with existing orders. Deactivate the account instead.');
        }

        $b2b->delete();

        return redirect()
            ->route('admin.ecommerce.b2b.index')
            ->with('success', 'B2B customer deleted successfully!');
    }

    /**
     * Toggle B2B customer active status.
     */
    public function toggleStatus(B2BCustomer $b2b)
    {
        $b2b->update([
            'is_active' => !$b2b->is_active,
        ]);

        $status = $b2b->is_active ? 'activated' : 'deactivated';

        return redirect()
            ->route('admin.ecommerce.b2b.show', $b2b)
            ->with('success', "B2B customer has been {$status}.");
    }

    /**
     * Get B2B statistics via AJAX.
     */
    public function statistics()
    {
        $topB2BCustomers = B2BCustomer::approved()
            ->withCount('orders')
            ->get()
            ->map(function ($b2b) {
                $b2b->total_purchase = $b2b->orders()->where('status', '!=', 'cancelled')->sum('final_amount');
                return $b2b;
            })
            ->sortByDesc('total_purchase')
            ->take(10)
            ->values();

        $b2bStats = [
            'total_b2b_customers' => B2BCustomer::count(),
            'pending_approvals' => B2BCustomer::pending()->count(),
            'approved_customers' => B2BCustomer::approved()->count(),
            'active_customers' => B2BCustomer::approved()->active()->count(),
            'total_b2b_revenue' => B2BCustomer::approved()
                ->get()
                ->sum(function ($b2b) {
                    return $b2b->orders()->where('status', '!=', 'cancelled')->sum('final_amount');
                }),
            'top_customers' => $topB2BCustomers,
        ];

        return response()->json($b2bStats);
    }
}
