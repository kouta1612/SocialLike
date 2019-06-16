<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeable;

    protected $appends = ['like', 'likes_count'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
