<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_meta;
use App\Models\Product;
use App\Models\Product_category;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

class categoryController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 25);
        $categories = Category::paginate($per_page);
        return Inertia::render('Categoriespage', ['categories' => $categories]);
    }
    public function get($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail( );
        $products = $this->products($category->id);
        $products = $this->mapProducts($products);
        $metas = $this->metas($category->id);
        return Inertia::render('Categoriespage', ['products' => $products, 'metas' => $metas]);
    }
    private function products($id)
    {
        $product_categories = Product_category::where('category_id', $id)->paginate(9);
        $products = $product_categories->transform(function($product_category) {
            $product = Product::where('id', $product_category->product_id)->first();
            return $product;
            });
        // $products = Product_category::where('category_id', $id)->with('product')->paginate(9);
        return $products;    
    }
    private function mapProducts($products)
    {
        return $products->map(function($product) {
            $product->image = $product->images()->first();
            return $product;
        });
    }
    private function metas($id)
    {
        return Category_meta::where('category_id', $id)->get();
    }
}
