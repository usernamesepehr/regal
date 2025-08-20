<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blog_comment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class blogController extends Controller
{
    public function all(Request $request)
    {
        $perPage = $request->input('per_pages', 9);
        $blogs = Blog::select('id', 'title', 'slug', 'created_at','description','thumbnail')->orderBy('id', 'desc')->simplePaginate($perPage);
        $latestBlogs = $blogs->take(4);
        return Inertia::render('Blogs', ['blogs' => $blogs, 'latestBlogs' => $latestBlogs]);
    }
    public function get($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $blogComments = Blog_comment::where('blog_id', $blog->id)->get();
        return Inertia::render('SingleBlog', ['blog' => $blog, 'comments' => $blogComments]);
    }
    
}
