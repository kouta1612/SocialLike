<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Article;
use Illuminate\Database\Eloquent\Relations\Relation;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'article' => Article::class,
            'post' => Post::class,
        ]);
    }
}
