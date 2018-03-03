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

Auth::routes();

Route::get('/', 'DashboardController@index');

Route::get('/home', 'PostController@index')->name('home')->middleware('auth');
Route::post('/posts/{id}/data', 'PostController@data')->name('posts.data');

// Resource
Route::resource('posts', 'PostController')->middleware('auth');
