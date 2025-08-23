<?php

namespace App\Http\Controllers;

use App\Http\Requests\blogcommentRequest;
use App\Models\Blog_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blogcommentController extends Controller
{
    public function add(blogcommentRequest $request)
    {
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        Blog_comment::create_comment($request, $user_id, $user_name);
    }
    public function destroy($id)
    {
        $user_id = Auth::id();
        Blog_comment::where('id', $id)->where('user_id', $user_id)->delete();
    }
}
