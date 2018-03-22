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
Route::get('register', function () {
    return view('auth.register');
});
Route::get('password/reset', function () {
    return view('auth.reset');
});




Route::group(['middleware' => 'web'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('register', 'Auth\RegisterController@create');
    Route::post('password/reset', 'Auth\ResetPasswordController@resetPassword');

    //Social providers login route
    Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

    Auth::routes();
    Route::get('home', 'HomeController@index');
    Route::get('users', 'UserController@getUsers');
    Route::any('users/search', 'UserController@searchUsers');
    Route::get('/', 'HomeController@index');

});




