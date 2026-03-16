<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    /**
     * Display the specified product.
     */
    public function show($slug)
    {
        $userId = auth()->id();

        $product = Product::where('slug', $slug)
            ->with(['category', 'primaryImage', 'reviews' => function($query) use ($userId) {
                $query->where(function($q) use ($userId) {
                    $q->where('is_approved', true)
                      ->orWhere(function($q) use ($userId) {
                          if ($userId) {
                              $q->where('user_id', $userId);
                          }
                      });
                })->latest();
            }])
            ->firstOrFail();

        // Get related products from same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with('primaryImage')
            ->take(8)
            ->get();

        return view('frontend.pages.product', compact('product', 'relatedProducts'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function storeReview(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        // Check if user already reviewed this product
        $existingReview = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this product.',
            ], 422);
        }

        $review = Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_approved' => false, // Reviews need admin approval
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your review! It will be published after approval.',
            'review' => $review,
        ]);
    }
}
