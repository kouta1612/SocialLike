<?php

namespace App\Http\Controllers;

use App\Article;

class LikeArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Article $article)
    {
        $article->like();
    }

    public function destroy(Article $article)
    {
        $article->unlike();
    }
}
