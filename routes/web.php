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

Route::view('/', 'content/content');

Route::get('category', 'CategoryController@index');
Route::post('category/register', 'CategoryController@store');
Route::put('category/update', 'CategoryController@update');
Route::put('category/deactivate', 'CategoryController@deactivate');
Route::put('category/activate', 'CategoryController@activate');
