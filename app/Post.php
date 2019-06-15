<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $appends = ['likes_count'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function like()
    {
        if ($this->likes()->where('user_id', auth()->id())->exists()) {
            return $this->likes()->where('user_id', auth()->id())->update(['like' => true]);
        }
        $this->likes()->create([
            'like' => true,
            'user_id' => auth()->id()
        ]);
    }

    public function unlike()
    {
        $this->likes()->where('user_id', auth()->id())->update(['like' => false]);
    }

    public function isLike()
    {
        return $this->likes()->where('user_id', auth()->id())->where('like', true)->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->where('like', true)->count();
    }
}
