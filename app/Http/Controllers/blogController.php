<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blog_comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;

class blogController extends Controller
{
    public function all(Request $request)
    {
        $perPage = $request->input('per_pages', 9);
        $blogs = $this->blogs($perPage);
        $blogs = $this->transformBlogs($blogs);
      
        $latestBlogs = $blogs->take(4);
        return response()->json(['blogs' => $blogs, 'latestBlogs' => $latestBlogs]);
        // return Inertia::render('Blogs', ['blogs' => $blogs, 'latestBlogs' => $latestBlogs]);
    }
    public function get($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blogComments = Blog_comment::where('blog_id', $blog->id)->get();
        return Inertia::render('SingleBlog', ['blog' => $blog, 'comments' => $blogComments]);
    }
    private function transformBlogs($blogs)
    {
        $blogs->transform(function($blog) {
            $blog->created_at = Jalalian::fromCarbon($blog->created_at);
            return $blog;
        });
        return $blogs;
    }
    private function blogs($perPage)
    {
        return Blog::select('id', 'title', 'slug', 'created_at','description','thumbnail')->orderBy('id', 'desc')->paginate($perPage);
    }
    
}
