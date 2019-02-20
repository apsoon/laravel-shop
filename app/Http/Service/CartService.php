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
use App\Http\Model\CartSku;

class CartService
{

    /**
     * @var CartSkuDao
     */
    private $cartSkuDao;

    private $skuDao;

    /**
     * 添加至购物车
     *
     * @param array $req
     * @return mixed
     */
    public function addSkuToCart(array $req)
    {
        // TODO 判断库存
        $cartSku = $this->cartSkuDao->findBySkuUser($req["userId"], $req["skuId"]);
        if ($cartSku) {
            $cartSku->number += $req["number"];
        } else {
            $cartSku = new CartSku();
            $cartSku->user_id = $req["userId"];
            $cartSku->sku_id = $req["skuId"];
            $cartSku->number = $req["number"];
        }
//        $sku = $this->skuDao->findByIdEffect()
        $result = $cartSku->save();
        return $result;
    }

    /**
     * 用户Id获取
     *
     * @param array $req
     * @return mixed
     */
    public function getCartByUserId(array $req)
    {
        $result = $this->cartSkuDao->findByUserId($req["userId"]);
        return $result;
    }

    /**
     * 用户删除或批量删除
     *
     * @param array $req
     * @return mixed
     */
    public function deleteCartSkusByUserId(array $req)
    {
        $skuIds = json_decode($req["skuIds"]);
        if (sizeof($skuIds) == 1) {
            $result = $this->cartSkuDao->deleteByUser($req["userId"], $skuIds[0]);
        } else {
            $result = $this->cartSkuDao->deleteListByUser($req["userId"], $skuIds);
        }
        return $result;
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