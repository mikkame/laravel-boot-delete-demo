<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($user) {
            $user->name = 'deleted';
            $user->email = 'deleted'.time();
            $user->save();
            foreach ($user->tweets as $tweet) {
                $tweet->delete();
            }
            foreach ($user->likes as $like) {
                $like->delete();
            }
        });
        
    }
}
