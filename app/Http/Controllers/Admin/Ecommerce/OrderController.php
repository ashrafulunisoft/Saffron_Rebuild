<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->withCount('orderItems')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.ecommerce.orders.index', compact('orders', 'stats'));
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product', 'orderItems.product.category']);

        return view('admin.ecommerce.orders.show', compact('order'));
    }

    /**
     * Update the specified order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $order->update([
            'status' => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()
            ->route('admin.ecommerce.orders.show', $order)
            ->with('success', 'Order updated successfully! অর্ডার সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Order $order)
    {
        // Check if order can be deleted (only pending orders can be deleted)
        if ($order->status !== 'pending' && $order->status !== 'cancelled') {
            return redirect()
                ->route('admin.ecommerce.orders.index')
                ->with('error', 'Cannot delete order that is being processed! প্রসেসিং অর্ডার মুছে ফেলা যাবে না!');
        }

        $order->delete();

        return redirect()
            ->route('admin.ecommerce.orders.index')
            ->with('success', 'Order deleted successfully! অর্ডার সফলভাবে মুছে ফেলা হয়েছে!');
    }

    /**
     * Update order status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'status' => $order->status,
            'message' => 'Order status updated successfully!'
        ]);
    }

    /**
     * Get order statistics.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics()
    {
        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'revenue' => Order::where('status', 'delivered')->sum('final_amount'),
            'pending_payment' => Order::where('payment_status', 'pending')->sum('final_amount'),
        ];

        return response()->json($stats);
    }

    /**
     * Search orders by order number or customer name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');

        $orders = Order::query()
            ->where('order_number', 'like', "%{$search}%")
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->with(['user', 'orderItems'])
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return response()->json($orders);
    }
}
