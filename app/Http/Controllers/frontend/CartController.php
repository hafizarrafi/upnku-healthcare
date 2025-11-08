<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; // <- perbaiki S besar

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $product_id  = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if (!Auth::check()) {
            return response()->json(['status' => "Please Login First..."]);
        }

        $product_check = Product::find($product_id);

        if (!$product_check) {
            return response()->json(['status' => "Product not found"]);
        }

        // TANPA cek email verified
        if (Cart::where('prod_id', $product_id)->where('user_id', Auth::id())->exists()) {
            return response()->json(['status'=> $product_check->name . " Already In Cart"]);
        }

        $cartItem = new Cart();
        $cartItem->prod_id  = $product_id;
        $cartItem->user_id  = Auth::id();
        $cartItem->prod_qty = $product_qty;
        $cartItem->save();

        return response()->json(['status' => $product_check->name . " Added to Cart"]);
    }

    public function viewCart()
    {
        $cartItem = Cart::where('user_id', Auth::id())->get();
        return view("frontend.cart", compact('cartItem'));
    }

    public function deleteProduct(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => "Please Login First..."]);
        }

        $prod_id = $request->input('prod_id');

        $cartItem = Cart::where('prod_id', $prod_id)
                        ->where('user_id', Auth::id())
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['status' => "Product Deleted successfully"]);
        }

        return response()->json(['status' => "Product not found in cart"]);
    }

    public function updateCart(Request $request)
    {
        $prod_id      = $request->input('prod_id');
        $product_qty  = $request->input('prod_qty');

        if (!Auth::check()) {
            return response()->json(['status' => "Please Login First..."]);
        }

        $cart = Cart::where('prod_id', $prod_id)
                    ->where('user_id', Auth::id())
                    ->first();

        if ($cart) {
            $cart->prod_qty = $product_qty;
            $cart->update();
            return response()->json(['status' => "Quantity Updated"]);
        }

        return response()->json(['status' => "Product not found in cart"]);
    }
}
