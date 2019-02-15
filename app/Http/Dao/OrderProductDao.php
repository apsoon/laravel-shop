<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 13:29
 */

namespace App\Http\Dao;


use App\Http\Model\OrderSku;

class OrderProductDao
{
    /**
     * @var OrderSku
     */
    private $orderProduct;

    /**
     * 订单id获取产品
     *
     * @param int $orderId
     * @return mixed
     */
    public function findByOrderId(int $orderId)
    {
        $result = $this->orderProduct::where(["order_id" => $orderId])
            ->get();
        return $result;
    }

    /**
     * 订单编号获取
     *
     * @param string $orderSn
     * @return mixed
     */
    private function findByOrderSn(string $orderSn)
    {
        $result = $this->orderProduct::where(["order_dn" => $orderSn])
            ->first();
        return $result;
    }

    /**
     * OrderProductDao constructor.
     *
     * @param OrderSku $orderProduct
     */
    public function __construct(OrderSku $orderProduct)
    {
        $this->orderProduct = $orderProduct;
    }
}