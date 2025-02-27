<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        
        session(['cart' => $cart]);
        return response()->json(['success' => true, 'cart' => $cart]);
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }
}
