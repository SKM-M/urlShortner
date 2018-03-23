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
    return view('auth.login');
});

Route::get('login', function () {
    return view('auth.login');
});


Route::group(['middleware' => ['web', 'iefix']], function () {
    // your routes here
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('register', 'Auth\RegisterController@create');
    Route::post('password/reset', 'Auth\ResetPasswordController@resetPassword');

    //Social providers login route
    Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

    Auth::routes();
    Route::get('home', 'HomeController@index');
    Route::get('urlShortner', 'UserController@shortnerURL');
    Route::post('urlShortner', 'UserController@urlShort');
    Route::get('/', 'HomeController@index');

});




