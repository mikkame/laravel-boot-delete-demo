<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $fillable = ['tweet_id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($like) {
            $like->user_id = auth()->user()->id;
        });
    }
}
