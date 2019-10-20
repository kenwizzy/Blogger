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

Route::auth();

Route::get('/home', 'HomeController@index');

//instead of doing a get or post, we use resource that has all the routes
Route::resource('admin/users', 'AdminUsersController');
Route::resource('admin/users/create', 'AdminUsersController@create');
Route::get('/admin', function(){
    return view('admin.index');
});
