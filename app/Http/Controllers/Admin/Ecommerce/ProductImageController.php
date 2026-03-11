<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Store a newly uploaded image.
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Check if this is the first image
        $isFirstImage = $product->images()->count() === 0;

        // Upload image
        $path = $request->file('image')->store('products', 'public');

        // Create image record
        $image = $product->images()->create([
            'image' => $path,
            'is_primary' => $isFirstImage, // First image is automatically primary
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully!',
            'image' => $image,
        ]);
    }

    /**
     * Set an image as primary.
     */
    public function setPrimary(Product $product, ProductImage $image)
    {
        // Remove primary status from all images
        $product->images()->update(['is_primary' => false]);

        // Set this image as primary
        $image->update(['is_primary' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Primary image updated successfully!',
        ]);
    }

    /**
     * Remove the specified image.
     */
    public function destroy(Product $product, ProductImage $image)
    {
        // Delete file from storage
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        // Delete database record
        $image->delete();

        // If this was the primary image and there are other images, set a new primary
        if ($image->is_primary && $product->images()->count() > 0) {
            $product->images()->first()->update(['is_primary' => true]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully!',
        ]);
    }

    /**
     * Update image alt/title (if needed in future).
     */
    public function update(Request $request, Product $product, ProductImage $image)
    {
        $request->validate([
            'alt_text' => 'nullable|string|max:255',
        ]);

        $image->update([
            'alt_text' => $request->alt_text,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Image updated successfully!',
        ]);
    }
}
