<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'users'] , function () {
    Route::controller(UserController::class)->group(function() {

    Route::post('register', 'register')->name('users.register');
    Route::post('login', 'login')->name('users.login');
    Route::get('', 'show')->middleware('auth:sanctum');
    Route::put('edit', 'update')->middleware('auth:sanctum')->name('users.update');
});
});

Route::group(['prefix' => 'products' , 'middleware'=>'auth:sanctum'] , function () {
    Route::controller(ProductController::class)->group(function() {

    Route::get('' , 'index');
    Route::get('{categoryName}' , 'showByCategory');
    Route::post('cart' , 'addToCart');
});
});

Route::group(['prefix' => 'categories' , 'middleware'=>'auth:sanctum'] , function () {
    Route::controller(CategoryController::class)->group(function() {

    Route::get('' , 'index');
});
});

Route::group(['prefix' => 'banners' , 'middleware'=>'auth:sanctum'] , function () {
    Route::controller(BannerController::class)->group(function() {

    Route::get('' , 'index');
});
});

Route::group(['prefix' => 'shipping' , 'middleware'=>'auth:sanctum'] , function () {
    Route::controller(ShippingController::class)->group(function() {

    Route::get('' , 'index');
    Route::post('create' , 'store');
    Route::put('edit/{id}' , 'update');
});
});