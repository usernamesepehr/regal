<?php

namespace App\Http\Controllers;

use App\Http\Requests\commentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    public function add(commentRequest $request)
    {
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        Comment::create_comment($request, $user_id, $user_name);
    }
    public function destroy($id)
    {
        $user_id = Auth::id();
        Comment::where('id', $id)->where('user_id', $user_id)->delete();
    }
}
