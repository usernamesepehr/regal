<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Option;
use App\Models\Product;
use App\Models\Product_category;
use App\Models\Product_option;
use App\Models\Rate;
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
        $comments = $this->comments($product->id);
        $rate = $this->rate($product->id);
        $categories = $this->categories($product->id);
        $options = $this->options($product->id);
        return Inertia::render('ProductsPage', ['product' => $product, 'comments' => $comments, 'rate' => $rate, 'categories' => $categories, 'options' => $options]);
    }
    private function products($per_page)
    {
        return Product::select('id', 'name', 'price', 'discount', 'slug')->orderBy('id', 'desc')->paginate($per_page);

    }
    private function mapProducts($products)
    {
        return $products->map(function($product) {
            $product->image = $product->images()->first();
            return $product;
        });
    }
    private function product($slug)
    {
        return Product::where('slug', $slug)->with('images')->firstOrFail();
    }
    private function categories($product_id)
    {
        return Product_category::where('product_id', $product_id)->with('category')->get();
    }
    private function comments($product_id)
    {
       return Comment::where('product_id', $product_id)->get();
    }
    private function rate($product_id)
    {
        return Rate::where('product_id', $product_id)->avg('rate');
    }
    private function options($product_id)
    {
        $product_options = Product_option::where('product_id', $product_id)->get();
        $product_options->transform(function ($product_option) {
            $options_id = array_map('intval', array_map('trim', explode(',', $product_option->options_id)));
            $product_option->option1 = Option::where('id', $options_id[0])->first();
            $product_option->option2 = Option::where('id', $options_id[1])->first();
            return $product_option;
        });
        return $product_options;
    }
}
