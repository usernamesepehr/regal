<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{
    public function index()
    {
        // $user_id = Auth::id();
        $user_id = 1;
        $wishlists = Wishlist::where('user_id', $user_id)->get();
        $products = collect();
        foreach($wishlists as $wishlist){
            $products = $products->merge(collect([$this->product($wishlist->product_id)]));
        }
        $products = $this->mapProducts($products);
        return response()->json(['products' => $products]);
    }
    private function product($id)
    {
        return Product::where('id', $id)->firstOrFail();
    }
    private function mapProducts($products)
    {
        return $products->map(function($product) {
            $product->image = $product->images()->first();
            return $product;
        });
    }
    public function add($id)
    { 
    // $user_id = Auth::id();
    $user_id = 1;
    $wishlistItem = Wishlist::where('product_id', $id)->where('user_id', $user_id)->first();
    
    if ($wishlistItem) {
        $wishlistItem->delete();
        return response()->json(['status' => false]);
    } else {
        Wishlist::create([
            'product_id' => $id,
            'user_id' => $user_id,
        ]);
        return response()->json(['status' => true]);
    }
    }
}
