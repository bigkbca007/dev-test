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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Posts -----------------------------------------------------------
Route::get('/posts/buscar', 'PostsController@buscar');
Route::get('/posts', 'PostsController@index');
Route::get('/posts/add', 'PostsController@create')->middleware('auth');
Route::post('/posts/store', 'PostsController@store')->middleware('auth');
Route::get('/posts/{id}', 'PostsController@show');
Route::delete('/posts/{id}', 'PostsController@destroy')->middleware('auth');
Route::get('/posts/filter', 'PostsController@filtrar');

// Categorias -------------------------------------------------------
Route::get('/categorias/getOptions', 'CategoriaController@getOptions');
Route::get('/categorias/buscar', 'CategoriaController@buscar');
Route::get('/categorias', 'CategoriaController@index');
Route::get('/categorias/add', 'CategoriaController@create')->middleware('auth');
Route::post('/categorias/store', 'CategoriaController@store')->middleware('auth');
Route::get('/categorias/{id}', 'CategoriaController@show');
Route::delete('/categorias/{id}', 'CategoriaController@destroy')->middleware('auth');

