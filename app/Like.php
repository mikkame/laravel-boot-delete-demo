<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['tweet_id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($like) {
            $like->user_id = auth()->user()->id;
        });
    }
}
