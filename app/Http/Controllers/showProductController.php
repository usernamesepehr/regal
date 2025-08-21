<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class showProductController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 9);
        $products = $this->products($per_page);
        $products = $this->mapProducts($products);
        return Inertia::render('products', ['products' => $products]);
    }
    public function get($slug)
    {
        $product = $this->product($slug);
    }
    private function products($per_page)
    {
        return Product::select('id', 'name', 'price', 'discount', 'slug')->orderBy('id', 'desc')->paginate($per_page);

    }
    private function mapProducts($products)
    {
        return $products->map(function($product) {
            $product->images = $product->images()->get();
            return $product;
        });
    }
    private function product($slug)
    {
        return Product::where('slug', $slug)->with('images')->first();
    }
}
