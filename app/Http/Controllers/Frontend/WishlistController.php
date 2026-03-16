<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Add product to wishlist.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'This product is not available.'
            ], 400);
        }

        // Support for guest users
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        // Check if already in wishlist
        $existing = Wishlist::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId)
                      ->orWhere('session_id', $sessionId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Product already in wishlist.'
            ], 400);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
            'product_id' => $request->product_id,
        ]);

        $wishlistCount = $this->getWishlistCount();

        return response()->json([
            'success' => true,
            'message' => 'Added to wishlist!',
            'wishlist_count' => $wishlistCount,
        ]);
    }

    /**
     * Remove product from wishlist.
     */
    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to manage wishlist.',
                'requires_auth' => true
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if (!$wishlistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist.'
            ], 404);
        }

        $wishlistItem->delete();

        $wishlistCount = Auth::user()->wishlist()->count();

        return response()->json([
            'success' => true,
            'message' => 'Removed from wishlist',
            'wishlist_count' => $wishlistCount,
        ]);
    }

    /**
     * Toggle wishlist (add if not exists, remove if exists).
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        $wishlistItem = Wishlist::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId)
                      ->orWhere('session_id', $sessionId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->where('product_id', $request->product_id)
            ->first();

        if ($wishlistItem) {
            // Remove from wishlist
            $wishlistItem->delete();
            $inWishlist = false;
            $message = 'Removed from wishlist';
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'product_id' => $request->product_id,
            ]);
            $inWishlist = true;
            $message = 'Added to wishlist!';
        }

        $wishlistCount = $this->getWishlistCount();

        return response()->json([
            'success' => true,
            'message' => $message,
            'in_wishlist' => $inWishlist,
            'wishlist_count' => $wishlistCount,
        ]);
    }

    /**
     * Check if product is in user's wishlist.
     */
    public function check(Request $request)
    {
        if ($request->has('product_id')) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);

            $userId = Auth::check() ? Auth::id() : null;
            $sessionId = session()->getId();

            $inWishlist = Wishlist::where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId)
                          ->orWhere('session_id', $sessionId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->where('product_id', $request->product_id)
                ->exists();

            return response()->json([
                'in_wishlist' => $inWishlist,
                'count' => $this->getWishlistCount()
            ]);
        }

        // Return just the count if no product_id specified
        return response()->json([
            'count' => $this->getWishlistCount()
        ]);
    }

    /**
     * Merge session wishlist to user wishlist after login.
     */
    public static function mergeSessionWishlist($userId)
    {
        // Get current session ID (after login)
        $currentSessionId = session()->getId();

        // Find all wishlist items that don't have a user_id
        Wishlist::whereNull('user_id')
            ->where(function($query) use ($currentSessionId) {
                $query->where('session_id', $currentSessionId)
                      ->orWhere('session_id', '!=', $currentSessionId);
            })
            ->get()
            ->each(function($item) use ($userId) {
                $existingItem = Wishlist::where('user_id', $userId)
                    ->where('product_id', $item->product_id)
                    ->first();

                if ($existingItem) {
                    // Already exists in user's wishlist, delete duplicate
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

    /**
     * Get wishlist count.
     */
    protected function getWishlistCount()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = session()->getId();

        return Wishlist::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId)
                      ->orWhere('session_id', $sessionId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->count();
    }
}
