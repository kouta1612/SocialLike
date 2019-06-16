<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\LikeTarget;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }
}