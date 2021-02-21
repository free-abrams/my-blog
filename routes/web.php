<?php

use Illuminate\Support\Facades\Route;

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
    return \route('article-post.index');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
	Route::get('/article-post', 'ArticleController@index')->name('article-post.index');
	Route::get('/article-post/{id}', 'ArticleController@show')->name('article-post.show');
});