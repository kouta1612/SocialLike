<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $postId = $request->postid;
        $isLike = $user->hasLike();

        Like::updateOrCreate(
            ['like' => !$isLike],
            ['user_id' => $user->id, 'post_id' => $postId, 'like' => true]
        );

        return redirect('/posts');
    }
}
