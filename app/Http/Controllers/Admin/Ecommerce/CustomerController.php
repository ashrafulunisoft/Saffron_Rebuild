<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of all customers.
     */
    public function index(Request $request)
    {
        $query = User::query()
            ->withCount('orders', 'reviews')
            ->orderBy('created_at', 'desc');

        // Search by name or email
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status (active/banned)
        if ($request->has('status') && $request->get('status') !== 'all') {
            if ($request->get('status') === 'active') {
                $query->whereNotNull('email_verified_at');
            } elseif ($request->get('status') === 'banned') {
                $query->where('banned', true);
            }
        }

        $customers = $query->paginate(20);

        // Get statistics
        $totalCustomers = User::count();
        $activeCustomers = User::whereNotNull('email_verified_at')->count();
        $bannedCustomers = User::where('banned', true)->count();
        $newCustomersThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();

        return view('admin.ecommerce.customers.index', compact(
            'customers',
            'totalCustomers',
            'activeCustomers',
            'bannedCustomers',
            'newCustomersThisMonth'
        ));
    }

    /**
     * Display the specified customer details.
     */
    public function show(User $customer)
    {
        // Load customer's orders with items
        $orders = $customer->orders()
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Customer statistics
        $totalOrders = $customer->orders()->count();
        $totalSpent = $customer->orders()->where('status', '!=', 'cancelled')->sum('final_amount');
        $averageOrderValue = $customer->orders()->where('status', '!=', 'cancelled')->avg('final_amount') ?? 0;
        $pendingOrders = $customer->orders()->where('status', 'pending')->count();
        $completedOrders = $customer->orders()->where('status', 'delivered')->count();
        $cancelledOrders = $customer->orders()->where('status', 'cancelled')->count();

        // Reviews by this customer
        $reviews = $customer->reviews()
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Points balance
        $pointsBalance = $customer->points_balance ?? 0;

        return view('admin.ecommerce.customers.show', compact(
            'customer',
            'orders',
            'totalOrders',
            'totalSpent',
            'averageOrderValue',
            'pendingOrders',
            'completedOrders',
            'cancelledOrders',
            'reviews',
            'pointsBalance'
        ));
    }

    /**
     * Update customer information.
     */
    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $customer->update($validated);

        return redirect()
            ->route('admin.ecommerce.customers.show', $customer)
            ->with('success', 'Customer updated successfully!');
    }

    /**
     * Toggle customer ban status.
     */
    public function toggleBan(User $customer)
    {
        $customer->update([
            'banned' => !$customer->banned,
        ]);

        $status = $customer->banned ? 'banned' : 'unbanned';

        return redirect()
            ->route('admin.ecommerce.customers.show', $customer)
            ->with('success', "Customer has been {$status}.");
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(User $customer)
    {
        // Check if customer has orders
        if ($customer->orders()->count() > 0) {
            return redirect()
                ->route('admin.ecommerce.customers.show', $customer)
                ->with('error', 'Cannot delete customer with existing orders. Please ban the account instead.');
        }

        $customer->delete();

        return redirect()
            ->route('admin.ecommerce.customers.index')
            ->with('success', 'Customer deleted successfully!');
    }

    /**
     * Get customer statistics via AJAX.
     */
    public function statistics()
    {
        $topCustomers = User::query()
            ->withCount('orders')
            ->get()
            ->map(function ($user) {
                $user->total_spent = $user->orders()->where('status', '!=', 'cancelled')->sum('final_amount');
                return $user;
            })
            ->sortByDesc('total_spent')
            ->take(10)
            ->values();

        $customerStats = [
            'total_customers' => User::count(),
            'active_customers' => User::whereNotNull('email_verified_at')->count(),
            'banned_customers' => User::where('banned', true)->count(),
            'new_this_month' => User::where('created_at', '>=', now()->startOfMonth())->count(),
            'top_customers' => $topCustomers,
        ];

        return response()->json($customerStats);
    }

    /**
     * Search customers via AJAX.
     */
    public function search(Request $request)
    {
        $search = $request->get('q');

        $customers = User::query()
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->take(10)
            ->get()
            ->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'orders_count' => $customer->orders_count ?? 0,
                ];
            });

        return response()->json($customers);
    }
}
