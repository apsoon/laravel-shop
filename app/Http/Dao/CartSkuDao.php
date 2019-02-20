<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 11:04
 */

namespace App\Http\Dao;


use App\Http\Model\CartSku;

class CartSkuDao
{
    /**
     * @var CartSku
     */
    private $catSku;

    public function insert(CartSku $cartSku)
    {
        return $cartSku->save();
    }

    /**
     * 用户分页获取
     *
     * @param string $userId
     * @return mixed
     */
    public function findByUserId(string $userId)
    {
        $result = $this->catSku::where("user_id", "=", $userId)
            ->get();
        return $result;
    }

    /**
     * 批量删除
     *
     * @param string $userId
     * @param int $skuId
     * @return mixed
     */
    public function deleteByUser(string $userId, int $skuId)
    {
        $result = $this->catSku::where(["user_id" => $userId, "sku_id" => $skuId])
            ->delete();
        return $result;
    }

    /**
     * 批量删除
     *
     * @param string $userId
     * @param array $skuIds
     * @return mixed
     */
    public function deleteListByUser(string $userId, array $skuIds)
    {
        $result = $this->catSku::where("user_id", "=", $userId)
            ->whereIn("sku_id", $skuIds)
            ->delete();
        return $result;
    }

    /**
     * CartSkuDao constructor.
     *
     * @param CartSku $cartSku
     */
    public function __construct(CartSku $cartSku)
    {
        $this->catSku = $cartSku;
    }
}