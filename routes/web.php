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

Route::any('/api/v1/post-cats', 'App\Http\Controllers\ServiceController@postRequestCategoryFrom1c');
Route::any('/api/v1/post-prods', 'App\Http\Controllers\ServiceController@postRequestProductFrom1c');

Route::get('/getdemodata', 'App\Http\Controllers\DemoController@getDemoData');
Route::post('/make-order', 'App\Http\Controllers\DemoController@postOrderTo1c')->name('make-order');
