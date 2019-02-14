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
    return view('index');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'web', 'namespace' => 'Mapi'], function () {

    // 首页
    Route::get('/index', 'IndexMapi@index');

    // SPU
    Route::GET("spu/list", "SpuMapi@list");
    Route::GET("spu/pagedList", "SpuMapi@listByPage");
    Route::POST("spu/create", "SpuMapi@create");
    Route::GET("spu/detail", "SpuMapi@detail");
    Route::POST("spu/relateSpec", "SpuMapi@relateSpec");
    Route::GET("spu/specList", "SpuMapi@listSpec");

    // SKU
    Route::POST("sku/create", "SkuMapi@create");

    // 分类
    Route::GET("category/list", "CategoryMapi@list");
    Route::GET("category/treeList", "CategoryMapi@treeList");
    Route::POST("category/create", "CategoryMapi@create");
    Route::POST("category/delete", "CategoryMapi@delete");

    // 品牌
    Route::GET("brand/list", "BrandMapi@list");
    Route::GET("brand/pagedList", "BrandMapi@listByPage");
    Route::POST("brand/create", "BrandMapi@create");
    Route::POST("brand/delete", "BrandMapi@delete");
    Route::POST("brand/modState", "BrandMapi@modifyState");

    // 属性
    Route::GET("attr/list", "AttributeMapi@list");
    Route::POST("attr/create", "AttributeMapi@create");
    Route::GET("attrGroup/add", "AttributeMapi@addGroup");
    Route::POST("attrGroup/create", "AttributeMapi@createGroup");
    Route::GET("attrOption/add", "AttributeMapi@addOption");
    Route::POST("attrOption/create", "AttributeMapi@createOption");

    // 规格
    Route::GET("spec/list", "SpecMapi@list");
    Route::GET("spec/add", "SpecMapi@add");
    Route::POST("spec/create", "SpecMapi@create");
    Route::GET("specOption/add", "SpecMapi@addOption");
    Route::POST("specOption/create", "SpecMapi@createOption");

    // 广告
    Route::GET("ad/list", "AdMapi@list");
    Route::GET("ad/add", "AdMapi@add");
    Route::POST("ad/create", "AdMapi@create");
    Route::POST("ad/modState", "AdMapi@modifyState");
    Route::POST("ad/delete", "AdMapi@delete");
    Route::GET("adPos/list", "AdMapi@listPosition");

    // 优惠券
    Route::GET("coupon/list", "CouponMapi@list");
    Route::GET("coupon/add", "CouponMapi@add");
    Route::POST("coupon/create", "CouponMapi@create");

    // 帮助
    Route::GET("help", function () {
        return view("admin.pages.help");
    });
});

Auth::routes();
