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

// 首页
Route::get('/', function () {
    return view('index');
});

Route::group(['middleware' => 'web', 'namespace' => 'Mapi'], function () {

    // ================================================  商品管理  =================================================
    // SPU
    Route::GET("spu/list", "SpuMapi@list");
    Route::GET("spu/pagedList", "SpuMapi@listByPage");
    Route::POST("spu/create", "SpuMapi@create");
    Route::GET("spu/detail", "SpuMapi@detail");
    Route::POST("spu/relateSpec", "SpuMapi@relateSpec");
    Route::GET("spu/specList", "SpuMapi@listSpec");
    Route::GET("spu/specOptionList", "SpuMapi@listSpecOption");
    Route::GET("spu/optionList", "SpuMapi@listOption");
    Route::POST("spu/createOption", "SpuMapi@createOption");
    Route::POST("spu/create-banner", "SpuMapi@createBanner");
    Route::POST("spu/modify-banner-state", "SpuMapi@modifyBannerState");
    Route::POST("spu/update-banner", "SpuMapi@updateBanner");
    Route::GET("spu/banner-list", "SpuMapi@bannerList");

    // SKU
    Route::POST("sku/create", "SkuMapi@create");
    Route::GET("sku/listBySpu", "SkuMapi@listBySpu");
    Route::POST("sku/recom", "SkuMapi@modifyRecom");

    // 分类
    Route::GET("category/list", "CategoryMapi@list");
    Route::GET("category/treeList", "CategoryMapi@treeList");
    Route::POST("category/create", "CategoryMapi@create");
    Route::POST("category/delete", "CategoryMapi@delete");
    Route::POST("category/recom", "CategoryMapi@modifyRecom");

    // 品牌
    Route::GET("brand/list", "BrandMapi@list");
    Route::GET("brand/pagedList", "BrandMapi@listByPage");
    Route::POST("brand/create", "BrandMapi@create");
    Route::POST("brand/update", "BrandMapi@update");
    Route::GET("brand/detail", "BrandMapi@detail");
    Route::POST("brand/delete", "BrandMapi@delete");
    Route::POST("brand/modState", "BrandMapi@modifyState");

    // 属性
    Route::GET("attr/list", "AttrMapi@list");
    Route::GET("attr/list-group", "AttrMapi@listByGroup");
    Route::GET("attr/list-category", "AttrMapi@listByCategory");
    Route::GET("attr/list-spu", "AttrMapi@listBySpu");
    Route::POST("attr/create", "AttrMapi@create");
    Route::GET("attrGroup/list", "AttrMapi@groupList");
    Route::POST("attrGroup/create", "AttrMapi@createGroup");
    Route::GET("attrOption/add", "AttrMapi@addOption");
    Route::POST("attrOption/create", "AttrMapi@createOption");

    // 规格
    Route::GET("spec/list", "SpecMapi@list");
    Route::GET("spec/add", "SpecMapi@add");
    Route::POST("spec/create", "SpecMapi@create");
    Route::GET("specOption/add", "SpecMapi@addOption");
    Route::POST("specOption/create", "SpecMapi@createOption");

    // ================================================  交易管理  =================================================
    Route::GET("order/list", "OrderMapi@list");
    Route::GET("order/detail", "OrderMapi@detail");
    Route::GET("comment/list", "CommentMapi@list");

    // ================================================  营销管理 =================================================
    // 优惠券
    Route::GET("coupon/list", "CouponMapi@list");
    Route::POST("coupon/create", "CouponMapi@create");

    // ================================================  用户管理  =================================================
    // 用户
    Route::GET("user/list-page", "UserMapi@listByPage");
    // 地址
    Route::GET("addr/list", "UserMapi@list");

    // ================================================  广告管理  =================================================
    // 广告
    Route::GET("ad/list", "AdMapi@list");
    Route::GET("ad/detail", "AdMapi@detail");
    Route::POST("ad/create", "AdMapi@create");
    Route::POST("ad/update", "AdMapi@update");
    Route::POST("ad/modState", "AdMapi@modifyState");
    Route::POST("ad/delete", "AdMapi@delete");
    Route::GET("adPos/list", "AdMapi@listPosition");

    // ================================================  广告管理  =================================================
    Route::POST("upload/image", "UploadMapi@image");

    // 帮助
    Route::GET("help", function () {
        return view("admin.pages.help");
    });
});

Auth::routes();
