<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cartItems = $this->getCartItems();

        $subtotal = $cartItems->sum(function($item) {
            return ($item->product->sale_price ?? $item->product->price) * $item->quantity;
        });

        // Shipping calculation (free shipping over 1000)
        $shipping = $subtotal >= 1000 ? 0 : 60;
        $total = $subtotal + $shipping;

        return view('frontend.pages.cart', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Add item to cart.
     */
    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1|max:10',
            ]);

            $product = Product::findOrFail($request->product_id);

            if (!$product->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'This product is not available.'
                ], 400);
            }

            $userId = Auth::check() ? Auth::id() : null;
            $sessionId = session()->getId();

            // Check if item already exists in cart
            $existingItem = Cart::where('product_id', $request->product_id)
                ->where(function($query) use ($userId, $sessionId) {
                    if ($userId) {
                        $query->where('user_id', $userId);
                    } else {
                        $query->where('session_id', $sessionId);
                    }
                })
                ->first();

            if ($existingItem) {
                $existingItem->increment('quantity', $request->quantity);
                $cartItem = $existingItem;
            } else {
                $cartItem = Cart::create([
                    'user_id' => $userId,
                    'session_id' => $userId ? null : $sessionId,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }

            $cartCount = $this->getCartCount();

            // Always return JSON for API requests
            return response()->json([
                'success' => true,
                'message' => 'Item added to cart successfully!',
                'cart_count' => (int)$cartCount,
            ]);
        } catch (\Exception $e) {
            \Log::error('Cart add error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);

        // Check ownership
        $this->checkCartOwnership($cartItem);

        $cartItem->update(['quantity' => $request->quantity]);

        $cartCount = $this->getCartCount();

        if ($request->ajax() || $request->wantsJson()) {
            // Recalculate totals
            $cartItems = $this->getCartItems();
            $subtotal = $cartItems->sum(function($item) {
                return ($item->product->sale_price ?? $item->product->price) * $item->quantity;
            });
            $shipping = $subtotal >= 1000 ? 0 : 60;

            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'cart_count' => (int)$cartCount,
                'subtotal' => number_format($subtotal, 2),
                'shipping' => $shipping,
                'total' => number_format($subtotal + $shipping, 2),
                'item_subtotal' => number_format(($cartItem->product->sale_price ?? $cartItem->product->price) * $cartItem->quantity, 2),
            ]);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);

        // Check ownership
        $this->checkCartOwnership($cartItem);

        $cartItem->delete();

        $cartCount = $this->getCartCount();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Item removed from cart!',
                'cart_count' => (int)$cartCount,
            ]);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    /**
     * Apply coupon code.
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $couponCode = strtoupper($request->coupon_code);

        // Find active coupon
        $coupon = Coupon::where('code', $couponCode)
            ->where('expires_at', '>', now())
            ->first();

        if (!$coupon || !$coupon->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired coupon code.',
            ], 404);
        }

        // Get cart subtotal
        $cartItems = $this->getCartItems();
        $subtotal = $cartItems->sum(function($item) {
            return ($item->product->sale_price ?? $item->product->price) * $item->quantity;
        });

        // Calculate discount
        $discount = $coupon->calculateDiscount($subtotal);

        // Store coupon in session
        Session::put('applied_coupon', [
            'code' => $coupon->code,
            'coupon_id' => $coupon->id,
            'discount' => $discount,
        ]);

        $shipping = $subtotal >= 1000 ? 0 : 60;
        $newTotal = $subtotal + $shipping - $discount;

        return response()->json([
            'success' => true,
            'message' => "Coupon applied successfully! You saved ৳{$discount}",
            'discount' => number_format($discount, 2),
            'new_total' => number_format(max(0, $newTotal), 2),
        ]);
    }

    /**
     * Get cart count for header.
     */
    public function count()
    {
        $count = $this->getCartCount();

        return response()->json([
            'count' => (int)$count,
        ]);
    }

    /**
     * Get cart items.
     */
    protected function getCartItems()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        return Cart::with('product')
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    // For authenticated users, get their cart items
                    // Include items that might still have session_id from before merge
                    $query->where('user_id', $userId)
                          ->orWhere(function($q) use ($userId, $sessionId) {
                              $q->whereNull('user_id')
                                ->where('session_id', $sessionId);
                          });
                } else {
                    // For guests, get only their session items
                    $query->where('session_id', $sessionId);
                }
            })
            ->get();
    }

    /**
     * Get cart count.
     */
    protected function getCartCount()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        return Cart::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId)
                      ->orWhere('session_id', $sessionId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->sum('quantity');
    }

    /**
     * Check cart ownership.
     */
    protected function checkCartOwnership($cartItem)
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        if ($userId) {
            if ($cartItem->user_id !== $userId && $cartItem->session_id !== $sessionId) {
                abort(403, 'Unauthorized action.');
            }
        } else {
            if ($cartItem->session_id !== $sessionId) {
                abort(403, 'Unauthorized action.');
            }
        }
    }

    /**
     * Merge session cart to user cart after login.
     */
    public static function mergeSessionCart($userId)
    {
        // Get current session ID (after login)
        $currentSessionId = session()->getId();

        // Find all cart items that don't have a user_id
        // This catches both:
        // 1. Items from the previous session (before login)
        // 2. Items in the current session that haven't been assigned
        Cart::whereNull('user_id')
            ->where(function($query) use ($currentSessionId) {
                $query->where('session_id', $currentSessionId)
                      ->orWhere('session_id', '!=', $currentSessionId);
            })
            ->get()
            ->each(function($item) use ($userId) {
                $existingItem = Cart::where('user_id', $userId)
                    ->where('product_id', $item->product_id)
                    ->first();

                if ($existingItem) {
                    // Merge quantities if item exists
                    $existingItem->increment('quantity', $item->quantity);
                    $item->delete();
                } else {
                    // Transfer ownership to user
                    $item->update([
                        'user_id' => $userId,
                        'session_id' => null,
                    ]);
                }
            });
    }
}
