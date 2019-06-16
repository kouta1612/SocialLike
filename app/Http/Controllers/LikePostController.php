<?php

namespace App\Http\Controllers;

use App\Post;

class LikePostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post)
    {
        $post->like();
    }

    public function destroy(Post $post)
    {
        $post->unlike();
    }
}
