<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["namespace" => "Fapi"], function () {

    // user 用户相关
    Route::POST("user/login", "UserFapi@login");
    Route::POST("user/set-info", "UserFapi@setUserInfo");
    Route::POST("user/createAddrs", "UserFapi@createAddrs");

    // category 分类
    Route::GET("category/list", "CategoryFapi@treeList");

    // spu 商品
    Route::GET("spu/list-category", "SpuFapi@listByCategory");
    Route::GET("spu/spec-list", "SpuFapi@SpecList");

    // sku 产品
    Route::GET("sku/list-spu", "SkuFapi@listBySpu");
    Route::GET("sku/list-category", "SkuFapi@listByCategory");
    Route::GET("sku/detail", "SkuFapi@detail");

    // cart 购物车
    Route::POST("cart/add", "CartFapi@create");
    Route::GET("cart/list", "CartFapi@list");
    Route::POST("cart/delete", "CartFapi@delete");
    Route::POST("cart/number", "CartFapi@number");

    // collection 收藏
    Route::POST("collection/create", "CollectionFapi@create");
    Route::GET("collection/list", "CollectionFapi@list");
    Route::POST("collection/delete", "CollectionFapi@remove");
    Route::GET("collection/check", "CollectionFapi@check");

    // 优惠券
    Route::GET("coupon/list", "CouponFapi@list");
    Route::POST("coupon/add", "CouponFapi@add");

    // 广告
    Route::GET("ad/list", "AdFapi@list");
});
