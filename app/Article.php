<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Likeable;

    protected $appends = ['like', 'likes_count'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }
}
