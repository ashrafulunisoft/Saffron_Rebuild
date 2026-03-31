<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    /**
     * Display search results.
     */
    public function index(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return redirect()->route('shop');
        }

        $products = Product::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name_en', 'like', "%{$query}%")
                    ->orWhere('name_bn', 'like', "%{$query}%")
                    ->orWhere('description_en', 'like', "%{$query}%")
                    ->orWhere('description_bn', 'like', "%{$query}%")
                    ->orWhereHas('category', function ($catQuery) use ($query) {
                        $catQuery->where('name_en', 'like', "%{$query}%")
                            ->orWhere('name_bn', 'like', "%{$query}%");
                    });
            })
            ->with(['category', 'primaryImage'])
            ->paginate(12);

        return view('frontend.pages.search', compact('products', 'query'));
    }

    /**
     * Autocomplete suggestions for search.
     */
    public function suggest(Request $request)
    {
        $query = trim($request->get('q', ''));

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name_en', 'like', "%{$query}%")
                    ->orWhere('name_bn', 'like', "%{$query}%")
                    ->orWhereHas('category', function ($catQuery) use ($query) {
                        $catQuery->where('name_en', 'like', "%{$query}%");
                    });
            })
            ->with(['category'])
            ->limit(8)
            ->get();

        $results = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name_en ?? $product->name,
                'slug' => $product->slug,
                'price' => $product->sale_price ?? $product->price,
                'original_price' => $product->sale_price ? $product->price : null,
                'image' => $product->image ? asset('storage/' . $product->image) : null,
                'category' => $product->category?->name_en,
                'url' => route('shop.product', $product->slug),
            ];
        });

        return response()->json($results);
    }
}
