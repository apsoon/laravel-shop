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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/index', function () {
    return view('admin.pages.index');
});


Route::group(['middleware' => 'web', 'namespace' => 'Mapi'], function () {

    // 商品
    Route::GET("goods/list", "GoodsMapi@list");
    Route::GET("goods/add", "GoodsMapi@add");
    Route::POST("goods/create", "GoodsMapi@createGoods");

    Route::GET("category/list", "CategoryMapi@list");
    // 品牌
    Route::GET("brand/list", "BrandMapi@list");
    Route::GET("brand/add", "BrandMapi@add");
    Route::POST("brand/create", "BrandMapi@createBrand");

    Route::GET("attribute/list", "AttributeMapi@list");

    Route::GET("specification/list", "SpecificationMapi@list");
    // 帮助
    Route::GET("help", function () {
        return view("admin.pages.help");
    });
});

Auth::routes();
