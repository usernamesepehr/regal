<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class mainpageController extends Controller
{
    public function index()
    {
        $categories = Category::take(6)->get();
        $products = Product::select('id', 'name', 'price', 'discount')->orderBy('id', 'desc')->take(8)->get();
        $products = $products->map(function($product) {
            $product->image = $product->images()->first(); // ستون واقعی تصویرت رو بذار
            return $product;
        });
        $blogs = Blog::select('id', 'title', 'slug', 'created_at','description','thumbnail')->orderBy('id', 'desc')->take(8)->get();
        $blogs->transform(function($blog) {
            $blog->created_at = Jalalian::fromCarbon($blog->created_at);
            return $blog;
        });
        return response()->json(['categories' => $categories, 'products' => $products, 'blogs' => $blogs]);
    }
}
