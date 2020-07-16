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


Auth::routes();


//Rotte pubbliche
Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/posts/{slug}', 'PostController@show')->name('posts.show');
Route::get('/categories/{slug}', 'CategoryController@show')->name('posts.category');
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/{slug}', 'PostController@category')->name('posts.category');


//Rotta che mappa la home page dell'amministratore
Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('/posts', 'PostController');
    });
