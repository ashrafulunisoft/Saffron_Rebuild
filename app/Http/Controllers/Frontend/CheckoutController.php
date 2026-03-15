<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        // Require authentication for checkout
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to proceed with checkout.');
        }

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Your cart is empty!');
        }

        // Calculate totals
        $totalAmount = $cartItems->sum(function($item) {
            return ($item->product->sale_price ?? $item->product->price) * $item->quantity;
        });

        // Shipping calculation (free shipping over 1000)
        $shipping = $totalAmount >= 1000 ? 0 : 60;
        $total = $totalAmount + $shipping;

        return view('frontend.pages.checkout', compact('cartItems', 'totalAmount', 'shipping', 'total'));
    }

    /**
     * Process the checkout and create order.
     */
    public function store(Request $request)
    {
        // Require authentication for checkout
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to proceed with checkout.');
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string',
            'payment_method' => 'required|in:cod,card,bkash',
        ]);

        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop')->with('error', 'Your cart is empty!');
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $totalAmount = $cartItems->sum(function($item) {
                return ($item->product->sale_price ?? $item->product->price) * $item->quantity;
            });

            // Shipping calculation (free shipping over 1000)
            $shipping = $totalAmount >= 1000 ? 0 : 60;
            $discount = 0;
            $finalAmount = $totalAmount + $shipping - $discount;

            // Build shipping address string
            $shippingAddress = json_encode([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
            ]);

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'final_amount' => $finalAmount,
                'payment_method' => $request->payment_method,
                'payment_status' => 'unpaid',
                'shipping_address' => $shippingAddress,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {
                $price = $item->product->sale_price ?? $item->product->price;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $price,
                    'quantity' => $item->quantity,
                ]);
            }

            // Clear the cart for authenticated user
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('customer.orders.show', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Checkout error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.')->withInput();
        }
    }

    /**
     * Get cart items for current user/session.
     */
    protected function getCartItems()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        return Cart::with('product')
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId)
                          ->orWhere('session_id', $sessionId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->get();
    }
}
