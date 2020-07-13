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


//Rotta che mappa la home page pubblica che ha una rotta standard come quelle viste fino ad ora
Route::get('/', 'HomeController@index')->name('home');

//Rotta che mappa la home page dell'amministratore
Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('/posts', 'PostController');
    });
