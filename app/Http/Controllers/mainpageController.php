<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;

class mainpageController extends Controller
{
    public function index()
    {
        $categories = $this->categories();
        $products = $this->products();
        $products = $this->mapProducts($products);
        $blogs = $this->blogs();
        $blogs = $this->transformBlogs($blogs);
        return response()->json([['categories' => $categories, 'products' => $products, 'blogs' => $blogs]]);
        // return Inertia::render('home', [['categories' => $categories, 'products' => $products, 'blogs' => $blogs]]);
    }
    private function categories()
    {
        return Category::take(6)->get();
    }
    private function products()
    {
        return Product::select('id', 'name', 'price', 'discount', 'slug')->orderBy('id', 'desc')->take(8)->get();
    }
    private function mapProducts($products)
    {
        return $products->map(function($product) {
            $product->image = $product->images()->first();
            return $product;
        });
    }
    private function blogs()
    {
        return Blog::select('id', 'title', 'slug', 'created_at','description','thumbnail')->orderBy('id', 'desc')->take(8)->get();
    }
    private function transformBlogs($blogs)
    {
        $blogs->transform(function($blog) {
            $blog->created_at = Jalalian::fromCarbon($blog->created_at);
            return $blog;
        });
        return $blogs;
    }
}
