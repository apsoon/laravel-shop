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
    Route::POST("user/create-addrs", "UserFapi@createAddrs");

    // category 分类
    Route::GET("category/list", "CategoryFapi@treeList");
    Route::GET("category/recom", "CategoryFapi@recom");

    // spu 商品
    Route::GET("spu/list-category", "SpuFapi@listByCategory");
    Route::GET("spu/spec-list", "SpuFapi@specList");
    Route::GET("spu/attr-list", "SpuFapi@attrList");
    Route::GET("spu/banner-list", "SpuFapi@bannerList");
    Route::GET("spu/detail", "SpuFapi@detail");

    // sku 产品
    Route::GET("sku/list-spu", "SkuFapi@listBySpu");
    Route::GET("sku/list-category", "SkuFapi@listByCategory");
    Route::GET("sku/list-category-brand", "SkuFapi@listByCategoryBrand");
    Route::GET("sku/detail", "SkuFapi@detail");
    Route::GET("sku/list", "SkuFapi@list");
    Route::GET("sku/recom", "SkuFapi@recom");
    Route::GET("sku/hot", "SkuFapi@hot");
    Route::GET("sku/search", "SkuFapi@search");

    // cart 购物车
    Route::POST("cart/add", "CartFapi@create");
    Route::GET("cart/list", "CartFapi@list");
    Route::POST("cart/delete", "CartFapi@delete");
    Route::POST("cart/number", "CartFapi@number");

    // collection 收藏
    Route::POST("collection/create", "CollectionFapi@create");
    Route::GET("collection/list", "CollectionFapi@list");
    Route::GET("collection/list-user", "CollectionFapi@listByUser");
    Route::POST("collection/delete", "CollectionFapi@remove");
    Route::GET("collection/check", "CollectionFapi@check");

    // 优惠券
    Route::GET("coupon/list-user", "CouponFapi@listByUser");
    Route::GET("coupon/list", "CouponFapi@list");
    Route::POST("coupon/add", "CouponFapi@add");

    // 广告
    Route::GET("ad/list", "AdFapi@list");

    // 订单
    Route::POST("order/create", "OrderFapi@create");
    Route::POST("order/pay", "OrderFapi@pay");
    Route::POST("order/receive", "OrderFapi@receive");
    Route::GET("order/callback", "OrderFapi@wxCallBack");
    Route::POST("order/callback", "OrderFapi@wxCallBack");
    Route::POST("order/cancel", "OrderFapi@cancel");
    Route::GET("order/number", "OrderFapi@number");
    Route::GET("order/list", "OrderFapi@list");
    Route::POST("order/delete", "OrderFapi@delete");

    // 评论
    Route::POST("comment/add", "CommentFapi@create");
    Route::GET("comment/list", "CommentFapi@list");

    // 售后
    Route::POST("after/create", "AfterSaleFapi@create");
    Route::POST("after/cancel", "AfterSaleFapi@cancel");
    Route::GET("after/list", "AfterSaleFapi@list");

    // 品牌
    Route::GET("brand/detail", "BrandFapi@detail");
});
