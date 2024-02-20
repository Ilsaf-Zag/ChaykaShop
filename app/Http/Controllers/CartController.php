<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;


class CartController extends Controller
{

    public function index()
    {
    }

    public function addProduct()
    {
        $product = Product::findOrFail(\request()->id);

        if ($cart = Cart::where(['session_id' => session()->getId(), 'product_id' => $product->id])->first()) {
            $cart->quantity++;
            $cart->save();
        } else {
            Cart::create([
                "session_id" => session()->getId(),
                "price" => $product->price,
                "product_id" => $product->id,
                "quantity" => 1,
            ]);

        }

        return back();
    }

    public function removeProduct(Cart $cart)
    {

       if($cart->quantity > 1)
       {
            $cart->quantity--;
            $cart->save();
        } else {
            $cart->delete();
        }

        return back();
    }
}
