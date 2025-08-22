<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product_option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function add(Request $request)
    {
        // $user_id = Auth::id();
        $user_id = 1;
        $options_id = implode(', ', $request->option_id);
        $quantity_available = $this->get_available_quantity($request->product_id, $options_id);
        $cart = $this->get_cart($request->product_id, $options_id, $user_id);
        if ($cart){
            if(($cart->quantity + $request->quntity) > $quantity_available->quantity){
                return response()->json([], 422);
            }
            $cart->quantity = ($cart->quantity + $request->quantity);
            $cart->save();
        }else{
            if($request->quantity > $quantity_available->quantity){
                return response()->json([], 422);
            }
            Cart::create_cart($request->quantity, $request->product_id, $options_id, $user_id);
        }
        
    }
    private function get_available_quantity($product_id, $options_id)
    {
        return Product_option::select('quantity')
                                        ->where('product_id', $product_id)
                                        ->where('options_id', $options_id)->firstOrFail();
    }
    private function get_cart($product_id, $options_id, $user_id)
    {
        return Cart::where('product_id', $product_id)->where('options_id', $options_id)->where('user_id', $user_id)->first();
    }
}
