<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews.
     */
    public function index()
    {
        $reviews = Review::with('user', 'product')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Statistics for the view
        $totalReviews = Review::count();
        $pendingReviews = Review::pending()->count();
        $approvedReviews = Review::approved()->count();
        $averageRating = Review::approved()->avg('rating') ?? 0;

        return view('admin.ecommerce.reviews.index', compact(
            'reviews',
            'totalReviews',
            'pendingReviews',
            'approvedReviews',
            'averageRating'
        ));
    }

    /**
     * Display pending reviews.
     */
    public function pending()
    {
        $reviews = Review::with('user', 'product')
            ->pending()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Statistics for the view
        $totalReviews = Review::count();
        $pendingReviews = Review::pending()->count();
        $approvedReviews = Review::approved()->count();
        $averageRating = Review::approved()->avg('rating') ?? 0;

        return view('admin.ecommerce.reviews.index', compact(
            'reviews',
            'totalReviews',
            'pendingReviews',
            'approvedReviews',
            'averageRating'
        ));
    }

    /**
     * Display approved reviews.
     */
    public function approved()
    {
        $reviews = Review::with('user', 'product')
            ->approved()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Statistics for the view
        $totalReviews = Review::count();
        $pendingReviews = Review::pending()->count();
        $approvedReviews = Review::approved()->count();
        $averageRating = Review::approved()->avg('rating') ?? 0;

        return view('admin.ecommerce.reviews.index', compact(
            'reviews',
            'totalReviews',
            'pendingReviews',
            'approvedReviews',
            'averageRating'
        ));
    }

    /**
     * Display the specified review.
     */
    public function show(Review $review)
    {
        $review->load(['user', 'product']);

        return view('admin.ecommerce.reviews.show', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $review->update([
            'is_approved' => $request->is_approved,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Review updated successfully! রিভিউ সফলভাবে আপডেট করা হয়েছে!');
    }

    /**
     * Approve a review.
     */
    public function approve(Review $review)
    {
        $review->update([
            'is_approved' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Review approved successfully! রিভিউ অনুমোদন করা হয়েছে!');
    }

    /**
     * Reject a review.
     */
    public function reject(Review $review)
    {
        $review->update([
            'is_approved' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Review rejected successfully! রিভিউ প্রত্যাখ্যান করা হয়েছে!');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()
            ->route('admin.ecommerce.reviews.index')
            ->with('success', 'Review deleted successfully! রিভিউ মুছে ফেলা হয়েছে!');
    }

    /**
     * Get reviews statistics.
     */
    public function statistics()
    {
        $totalReviews = Review::count();
        $pendingReviews = Review::pending()->count();
        $approvedReviews = Review::approved()->count();

        $averageRating = Review::approved()->avg('rating') ?? 0;

        $ratingDistribution = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDistribution[$i] = Review::approved()->where('rating', $i)->count();
        }

        return response()->json([
            'total' => $totalReviews,
            'pending' => $pendingReviews,
            'approved' => $approvedReviews,
            'average_rating' => number_format($averageRating, 1),
            'rating_distribution' => $ratingDistribution,
        ]);
    }

    /**
     * Search reviews.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $reviews = Review::with('user', 'product')
            ->where('comment', 'like', "%{$query}%")
            ->orWhereHas('user', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orWhereHas('product', function ($q) use ($query) {
                $q->where('name_en', 'like', "%{$query}%")
                  ->orWhere('name_bn', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Statistics for the view
        $totalReviews = Review::count();
        $pendingReviews = Review::pending()->count();
        $approvedReviews = Review::approved()->count();
        $averageRating = Review::approved()->avg('rating') ?? 0;

        return view('admin.ecommerce.reviews.index', compact(
            'reviews',
            'query',
            'totalReviews',
            'pendingReviews',
            'approvedReviews',
            'averageRating'
        ));
    }
}
