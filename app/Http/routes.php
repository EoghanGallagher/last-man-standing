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


/*
Route::get( 'home' , [
    'middleware' => 'auth',
    'uses' => 'PagesController@home'
]);*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Fixtures Route
Route::get( 'fixtures' , 'PagesController@Fixtures' );

//Team Selection Route
//Route::get('matches', 'PagesController@TeamSelectionScreen');

Route::get('matches', ['middleware' => 'auth', 'uses' => 'PagesController@TeamSelectionScreen']);



Route::get('/teams', 'PlayersController@TeamList');

Route::post( 'playerpicks' , 'PlayersController@PlayerPicks' );


Route::get('token', function ()
{
    return csrf_token();
});




