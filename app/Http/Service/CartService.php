<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 11:05
 */

namespace App\Http\Service;


use App\Http\Dao\CartSkuDao;
use App\Http\Dao\SkuDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\CartSku;
use App\Http\Util\JsonResult;

class CartService
{

    /**
     * @var CartSkuDao
     */
    private $cartSkuDao;

    /**
     * @var SkuDao
     */
    private $skuDao;

    /**
     * 添加至购物车
     *
     * @param array $req
     * @return JsonResult
     */
    public function addSkuToCart(array $req)
    {
        $cartSku = $this->cartSkuDao->findBySkuUser($req["userId"], $req["skuId"]);
        if ($cartSku) {
            $cartSku->number += $req["number"];
        } else {
            $cartSku = new CartSku();
            $cartSku->user_id = $req["userId"];
            $cartSku->sku_id = $req["skuId"];
            $cartSku->number = $req["number"];
        }
        $sku = $this->skuDao->findByIdEffect($req["skuId"]);
        if (!$sku || $sku->number < $cartSku->number) {
            return new JsonResult(StatusCode::STOCK_NOT_ENOUGH);
        }
        $result = $cartSku->save();
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 用户Id获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getCartByUserId(array $req)
    {
        $result = $this->cartSkuDao->findByUserId($req["userId"]);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 用户删除或批量删除
     *
     * @param array $req
     * @return JsonResult
     */
    public function deleteCartSkusByUserId(array $req)
    {
        $skuIds = json_decode($req["skuIds"]);
        if (sizeof($skuIds) == 1) {
            $result = $this->cartSkuDao->deleteByUser($req["userId"], $skuIds[0]);
        } else {
            $result = $this->cartSkuDao->deleteListByUser($req["userId"], $skuIds);
        }
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * CartService constructor.
     *
     * @param CartSkuDao $cartSkuDao
     * @param SkuDao $skuDao
     */
    public function __construct(CartSkuDao $cartSkuDao, SkuDao $skuDao)
    {
        $this->cartSkuDao = $cartSkuDao;
        $this->skuDao = $skuDao;
    }
}