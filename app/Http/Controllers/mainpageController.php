<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;


include_once __DIR__ . "../../../../libs/jdf.php";

class mainpageController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'categories' => Inertia::defer(group: 'category', fn () => $this->categories()),
            'products'   => Inertia::defer(group: 'product', fn () => $this->mapProducts($this->products())),
            'blogs'      => Inertia::defer(group: 'blog', fn () => $this->transformBlogs($this->blogs())),
        ]);
        
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
        return Blog::select('id', 'title', 'slug', 'description','thumbnail')->orderBy('id', 'desc')->take(8)->get();
    }
    private function transformBlogs($blogs)
    {
        $blogs->transform(function($blog) {
            $blog->timestamp = jdate('F j', (int) $blog->timestamp);
            return $blog;
        });
        return $blogs;
    }
}
