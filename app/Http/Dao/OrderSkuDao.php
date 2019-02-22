<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 13:29
 */

namespace App\Http\Dao;

use App\Http\Model\OrderSku;
use Illuminate\Support\Facades\DB;

class OrderSkuDao
{
    /**
     * @var OrderSku
     */
    private $orderSku;

    /**
     * 订单id获取产品
     *
     * @param int $orderId
     * @return mixed
     */
    public function findByOrderId(int $orderId)
    {
        $result = $this->orderSku::where(["order_id" => $orderId])
            ->get();
        return $result;
    }

    /**
     * 批量增加
     *
     * @param array $skuList
     * @return bool
     */
    public function insertList(array $skuList)
    {
        $result = DB::table($this->orderSku->getTable())->insert($skuList);
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
        $result = $this->orderSku::where(["order_dn" => $orderSn])
            ->first();
        return $result;
    }

    /**
     * OrderSkuDao constructor.
     *
     * @param OrderSku $orderSku
     */
    public function __construct(OrderSku $orderSku)
    {
        $this->orderSku = $orderSku;
    }
}