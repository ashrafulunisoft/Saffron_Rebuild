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
}
