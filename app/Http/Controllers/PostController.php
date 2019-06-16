<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\LikeTarget;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }
}
