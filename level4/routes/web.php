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

Route::get('/', 'BooksController@index');

Route::get('/books', 'BooksController@index');

Route::get('/books/{bookId}', 'BooksController@show');

Route::get('/books/click', 'BooksController@clickBook');

Route::get('/admin', 'AdminController@index');

Route::post('/admin', 'AdminController@store');

Route::delete('/admin/{bookId}', 'AdminController@destroy');


