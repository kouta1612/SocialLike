<?php

namespace App;

trait Likeable
{
    public function like()
    {
        $this->likes()->where('user_id', auth()->id())->updateOrCreate(
            ['like' => false],
            ['user_id' => auth()->id(), 'like' => true]
        );
    }

    public function unlike()
    {
        $this->likes()->where('user_id', auth()->id())->update(['like' => false]);
    }

    public function hasLike()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    public function getLikeAttribute()
    {
        return $this->likes()->where('user_id', auth()->id())->where('like', true)->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->where('like', true)->count();
    }
}
