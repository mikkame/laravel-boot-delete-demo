<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use SoftDeletes;

    protected $fillable = ['message'];
    public static function posMessage()
    {
        return collect([
            'こんにちは',
            '良い天気ですね',
            'メロスは走った',
            '雨です',
            'つぶやいた',
            'バグった',
            'バズった',
        ])->random();
    }

    public static function badMessage()
    {
        return collect([
            'rm -rf *',
            '; 1=1',
            '; bash '
        ])->random();
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($tweet) {
            $tweet->user_id = auth()->user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


}
