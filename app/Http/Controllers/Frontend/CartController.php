<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        return view('frontend.pages.cart');
    }

    /**
     * Add item to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'qty' => $request->quantity,
            'options' => [
                'image' => $request->image ?? null,
            ]
        ]);

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    /**
     * Update cart item.
     */
    public function update(Request $request)
    {
        $request->validate([
            'rowId' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        Cart::update($request->rowId, $request->quantity);

        return redirect()->back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        $request->validate([
            'rowId' => 'required',
        ]);

        Cart::remove($request->rowId);

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
