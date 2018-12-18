<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->mode == 'normal') {
            Tweet::create(['message' => Tweet::posMessage()]);
        } else {
            Tweet::create(['message' => Tweet::badMessage()]);
        }
        return back();
    }


  

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        $this->authorize('delete', $tweet);
        $tweet->delete();
        return back();
    }
}
