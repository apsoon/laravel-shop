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
    Route::POST("spu/create", "SpuMapi@create");
    Route::GET("spu/detail", "SpuMapi@detail");

    // SKU
    Route::POST("sku/create", "SkuMapi@create");

    // 分类
    Route::GET("category/list", "CategoryMapi@list");
    Route::GET("category/add", "CategoryMapi@add");
    Route::POST("category/create", "CategoryMapi@create");

    // 品牌
    Route::GET("brand/list", "BrandMapi@list");
    Route::GET("brand/pagedList", "BrandMapi@listByPage");
    Route::POST("brand/create", "BrandMapi@createBrand");

    // 属性
    Route::GET("attr/list", "AttributeMapi@list");
    Route::POST("attr/create", "AttributeMapi@create");
    Route::GET("attrGroup/add", "AttributeMapi@addGroup");
    Route::POST("attrGroup/create", "AttributeMapi@createGroup");
    Route::GET("attrOption/add", "AttributeMapi@addOption");
    Route::POST("attrOption/create", "AttributeMapi@createOption");

    // 规格
    Route::GET("spec/list", "SpecificationMapi@list");
    Route::GET("spec/add", "SpecificationMapi@add");
    Route::POST("spec/create", "SpecificationMapi@create");
    Route::GET("specOption/add", "SpecificationMapi@addOption");
    Route::POST("specOption/create", "SpecificationMapi@createOption");

    // 广告
    Route::GET("ad/list", "AdMapi@list");
    Route::GET("ad/add", "AdMapi@add");
    Route::POST("ad/create", "AdMapi@create");
    Route::POST("ad/modState", "AdMapi@ModifyState");
    Route::POST("ad/delete", "AdMapi@delete");
    Route::GET("adPosition/list", "AdMapi@listPosition");

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
