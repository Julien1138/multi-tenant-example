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
    return redirect('home');
});

Auth::routes();

Route::domain(config('tenancy.hostname.default'))->group(function () {
    Route::get('/home', 'BlogController@index')->name('home');
});

Route::get('/home', 'ArticleController@index')->name('home');

Route::resource('/blogs', 'BlogController');
Route::resource('/articles', 'ArticleController');