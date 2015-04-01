<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getHome');
Route::get('/search/{query}/{page?}', 'SearchController@getSearchResult');
Route::get('/search', function(){ return Redirect::to('/');});
Route::get('/paper/{hash}', 'PaperController@getPaper');

Route::get('/user/reg', 'UserController@getRegister');
Route::get('/user/login', 'UserController@getLogin');
Route::get('/user/logout', 'UserController@getLogout');
Route::post('/user/create', 'UserController@postCreate');
Route::post('/user/auth', 'UserController@postAuth');



Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::guest('user/login');
});
