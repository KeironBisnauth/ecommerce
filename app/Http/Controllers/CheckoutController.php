<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
        public function index()
    {
        // Check if the user is logged and which groups
        $group_ids = Auth::check() ? Auth::user()->getGroups() : [1];
        // get the user who is logged in
        $user = Auth::user();
        // get products user added to cart
        $cart_data = $user->products()->withPrices()->get();
        // check if the cart is empty
        if ($cart_data->isEmpty()) {
            // Redirect the user to the cart page with a message
            return redirect()->route('cart.index')->with('message', 'Your cart is empty');
        }
        // calculate subtotal
        $cart_data->calculateSubtotal();
        // load checkout page
        return view('pages.default.checkoutpage', compact('cart_data'));
    }
}
