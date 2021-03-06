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

Route::get('/', 'PostController@index');

Route::get('/posts', 'PostController@index');
Route::get('/articles', 'ArticleController@index');

Route::post('/like/{type}/{id}', 'LikeController@store');
Route::delete('/like/{type}/{id}', 'LikeController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
