<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;

class searchController extends Controller
{
    public function product(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%'.$request->input('q').'%')
                           ->get();
        return response()->json(['products' => $products]);                   
    }
    public function blog(Request $request)
    {
        $blogs = Blog::where('title', 'LIKE', '%'.$request->input('q').'%')
        ->get();
        return response()->json(['blogs' => $blogs]);
    }
}
