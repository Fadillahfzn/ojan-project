<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_to_cart(Product $product, Request $request) {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $product->stock
        ]);

        $user_id = Auth::id();
        $product_id = $product->id;

        Cart::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'amount' => $request->amount
        ]);

        return Redirect::route('index_product');
    }

    public function show_cart() {
        $user_id = Auth::id();
        $carts =  Cart::where('user_id', $user_id)->get();
        return view('show_cart', compact('carts'));
    }

    public function update_cart(Cart $cart, Request $request) {
        $request->validate([
            'amount' => 'required|gte:1|lte:' . $cart->product->stock
        ]);

        $cart->update([
            'amount' => $request->amount
        ]);

        return Redirect::route('show_cart');
    }
}
