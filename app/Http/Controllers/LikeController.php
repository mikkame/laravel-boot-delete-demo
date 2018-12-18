<?php

namespace App\Http\Controllers;

use App\Like;
use App\Tweet;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function store(Request $request, Tweet $tweet)
    {
        Like::create(['tweet_id' => $tweet->id]);
        return back();
    }

}
