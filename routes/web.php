<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //本来はcronに書くべきだが、herokuで運用しようと思うので取りあえずここに
    Artisan::call('user:delete');
    Artisan::call('tweet:moderate');
    
    $tweets = App\Tweet::orderBy('created_at', 'desc')->take(100)->get();
    return view('welcome', compact('tweets'));
});


Route::post('/register', function () {
    $user = factory(App\User::class)->create();
    auth()->loginUsingId($user->id);
    return back();
});


Route::post('/logout', function () {
    auth()->logout();
    return back();
});

Route::post('/deactive', function () {
    $user = auth()->user();
    auth()->logout();
    $user->delete();
    return back();
});


Route::group(['middleware' => 'auth'], function (){
    Route::resource('tweet', 'TweetController')->only(['store', 'destroy']);
    Route::resource('like/{tweet}/', 'LikeController')->only(['store'])->names([
        'store' => 'like.store' //FIXME この修正方法以外で綺麗なのあったらおしえてください
    ]);
});

