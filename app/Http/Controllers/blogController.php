<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Blog_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

include_once __DIR__ . "../../../../libs/jdf.php";


class blogController extends Controller
{
    public function all(Request $request)
    {
       $perPage = $request->input('per_pages', 9);

      return Inertia::render('Blogs', [
        'blogs'       => Inertia::defer(fn () => $this->transformBlogs($this->blogs($perPage))),
        'latestBlogs' => Inertia::defer(fn () => $this->transformBlogs($this->blogs($perPage))->take(4)),
      ]);
    }
    public function get($slug)
    {
     return Inertia::render('SingleBlog', [
        'blog' => Inertia::defer(fn () => tap(Blog::where('slug', $slug)->firstOrFail(), function($blog) {
            $blog->timestamp = jdate('F j', (int) $blog->timestamp);
        })),
        'comments' => Inertia::defer(fn () => $this->blogComments($slug)),
        'userComments' => Inertia::defer(fn () => $this->user_comments(Blog::where('slug', $slug)->firstOrFail()->id)),
    ]);
    }
    private function transformBlogs($blogs)
    {
        $blogs->transform(function($blog) {
            $blog->timestamp = jdate('F j', (int) $blog->timestamp);
            return $blog;
        });
        return $blogs;
    }
    private function blogs($perPage)
    {
        return Blog::select('id', 'title', 'slug', 'timestamp','description','thumbnail')->orderBy('id', 'desc')->paginate($perPage);
    }
    private function user_comments($blog_id)
    {
        $user_id = Auth::id();
        return Blog_comment::where('user_id', $user_id)
        ->where('blog_id', $blog_id)
        ->pluck('id'); 
    }
    private function blogComments(string $slug)
    {
       $blog = Blog::where('slug', $slug)->firstOrFail();
       return Blog_comment::where('blog_id', $blog->id)->get();
    }
}
