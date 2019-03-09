<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/tweets','TweetController');
Route::get('/hash_tags/{id}/tweets','TweetController@showByHashTag')->name('hash_tags.tweets');

//comment
Route::resource('/comments','CommentController');
Route::get('/comments_show/{tweets_id}/{comments_id}','CommentController@comment_show');
Route::post('/comments_show','CommentController@comment_store');

//test
Route::get('/tests','TestController@index');
Route::get('/tests/create','TestController@create');
Route::post('/tests','TestController@store');
Route::get('/tests/{id}','TestController@show');
Route::get('/tests/{id}/edit','TestController@edit');
Route::put('/tests/{id}','TestController@update');
Route::delete('/tests/{id}','TestController@destroy');

//sec_test
Route::get('/sec_tests','SecTestController@index');


//good
Route::get('/goods','GoodController@index');
Route::post('/goods','GoodController@store');




Route::get('/user/{id}/profile','UserProfileController@show');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('auth.getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('auth.getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('auth.getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister')->name('auth.postRegister');

