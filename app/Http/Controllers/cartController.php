<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Option;
use App\Models\Product;
use App\Models\Product_option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 9);
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->paginate();
        foreach ($carts as $cart){
            $cart->product = collect($this->product($cart->product_id, $cart->options_id));
        }
        return response()->json(['carts' => $carts]);
    }
    public function add(Request $request)
    {
        $user_id = Auth::id();
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
    public function destroy($id)
    {
        $user_id = Auth::id();
        Cart::where('user_id', $user_id)->where('id', $id)->delete();
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
    private function product($product_id, $options_id)
    {
        $product = Product::where('id', $product_id)->first();
        $options_id = array_map('intval', array_map('trim', explode(',', $options_id)));
        $product->option1 = Option::where('id', $options_id[0])->first();
        $product->option2 = Option::where('id', $options_id[1])->first();
        return $product;
    }
}
