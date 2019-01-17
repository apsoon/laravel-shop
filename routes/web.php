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

Route::group(['middleware' => 'web', 'namespace' => 'Mapi'], function () {

    // 首页
    Route::get('/index', 'IndexMapi@index');

    // 商品
    Route::GET("goods/list", "GoodsMapi@list");
    Route::GET("goods/add", "GoodsMapi@add");
    Route::POST("goods/create", "GoodsMapi@createGoods");
    Route::GET("product/add", "GoodsMapi@addProduct");

    // 分类
    Route::GET("category/list", "CategoryMapi@list");
    Route::GET("category/add", "CategoryMapi@add");
    Route::POST("category/create", "CategoryMapi@create");

    // 品牌
    Route::GET("brand/list", "BrandMapi@list");
    Route::GET("brand/add", "BrandMapi@add");
    Route::POST("brand/create", "BrandMapi@createBrand");

    // 属性
    Route::GET("attribute/list", "AttributeMapi@list");
    Route::GET("attribute/add", "AttributeMapi@add");
    Route::POST("attribute/create", "AttributeMapi@create");
    Route::GET("attributeGroup/add", "AttributeMapi@addGroup");
    Route::POST("attributeGroup/create", "AttributeMapi@createGroup");

    // 规格
    Route::GET("specification/list", "SpecificationMapi@list");
    Route::GET("specification/add", "SpecificationMapi@add");
    Route::POST("specification/create", "SpecificationMapi@create");

    // 帮助
    Route::GET("help", function () {
        return view("admin.pages.help");
    });
});

Auth::routes();
