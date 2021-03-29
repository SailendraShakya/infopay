<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController;

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

Route::get('/', [App\Http\Controllers\Frontend\ProductController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('products', ProductController::class);
Route::get('products-scarping', [ProductController::class, 'scraping_listing'])->name('scarping-listing');
Route::get('products-scarping-generate', [ProductController::class, 'scarping'])->name('scarping');

Route::get('products-api', [ProductController::class, 'product_api'])->name('api-listing');
Route::get('products-api-fetch', [ProductController::class, 'api'])->name('api_fetch');

