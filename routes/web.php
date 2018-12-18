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
    return view('welcome');
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
