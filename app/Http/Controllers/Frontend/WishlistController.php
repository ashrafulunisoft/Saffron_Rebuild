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
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to wishlist.',
                'requires_auth' => true
            ], 401);
        }

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

        // Check if already in wishlist
        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Product already in wishlist.'
            ], 400);
        }

        // Add to wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
        ]);

        $wishlistCount = Auth::user()->wishlist()->count();

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
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to wishlist.',
                'requires_auth' => true
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlistItem) {
            // Remove from wishlist
            $wishlistItem->delete();
            $inWishlist = false;
            $message = 'Removed from wishlist';
        } else {
            // Add to wishlist
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ]);
            $inWishlist = true;
            $message = 'Added to wishlist!';
        }

        $wishlistCount = Auth::user()->wishlist()->count();

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
        if (!Auth::check()) {
            return response()->json([
                'in_wishlist' => false,
                'count' => 0
            ]);
        }

        if ($request->has('product_id')) {
            $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);

            $inWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->exists();

            return response()->json([
                'in_wishlist' => $inWishlist,
                'count' => Auth::user()->wishlist()->count()
            ]);
        }

        // Return just the count if no product_id specified
        return response()->json([
            'count' => Auth::user()->wishlist()->count()
        ]);
    }
}
