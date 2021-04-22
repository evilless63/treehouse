<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ImportController;
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
    return redirect('/admin/categories');
});

// Route::any('/api/v1/post-cats', 'App\Http\Controllers\ServiceController@postRequestCategoryFrom1c');
// Route::any('/api/v1/post-prods', 'App\Http\Controllers\ServiceController@postRequestProductFrom1c');

// Route::get('/refereshcapcha', 'App\Http\Controllers\HelperController@refereshCapcha');
// Route::get('/getdemodata', 'App\Http\Controllers\DemoController@getDemoData');
// Route::get('/register', 'App\Http\Controllers\DemoController@registerNewCounteragent');
// Route::get('/policy', 'App\Http\Controllers\DemoController@policy')->name('policy');

// Route::post('/make-order', 'App\Http\Controllers\DemoController@postOrderTo1c')->name('make-order');
// Route::post('/register-counteragent', 'App\Http\Controllers\DemoController@postCounteragentRegisterTo1c')->name('register-counteragent');

Route::prefix('admin')->group(function(){
    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'colors' => ColorController::class,
        'sizes' => SizeController::class,
    ]);

    Route::any('/categories/{id}/replicate', [CategoryController::class, 'replicate'])->name('categories.replicate');

    Route::post('/api/v1/importdata/colors', [ImportController::class, 'ImportColorsFrom1c']);
    Route::post('/api/v1/importdata/sizes', [ImportController::class, 'ImportSizesFrom1c']);
    Route::post('/api/v1/importdata/products', [ImportController::class, 'ImportProductsFrom1c']);
});
