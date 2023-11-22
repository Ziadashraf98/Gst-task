<?php

use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix'=>'dashboard'],function(){

    Auth::routes(['register'=>false]);
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:admin']
    ], function(){ 
        
        
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
        
    Route::group(['prefix'=>'dashboard'],function(){

        Route::resources([
            'users'=>UserController::class,
            'categories'=>CategoryController::class,
            'products'=>ProductController::class,
            'banners'=>BannerController::class,
        ]);
        
        Route::delete('delete_image/{id}' , [ProductController::class , 'delete_image'])->name('delete_image');
        Route::get('/delet/{id}' , [UserController::class , 'activation'])->name('activation');
    });
});