<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/10
 * Time: 10:13
 */

namespace App\Http\Enum;

/**
 * Class OrderStatus
 * 订单状态
 *
 * @package App\Http\Enum
 */
class OrderStatus
{
    const  PAY_REQUIRED = ["code" => 0, "key" => "pay"]; // 待付款
    const DELIVERY_REQUIRED = ["code" => 1, "key" => "send"]; // 待发货
    const RECEIVE_REQUIRED = ["code" => 2, "key" => "receive"]; // 待收货
    const COMMENT_REQUIRED = ["code" => 3, "key" => "comment"]; // 待评论
    const COMPLETE = ["code" => 4, "key" => "complete"]; // 订单完成
    const CANCEL = ["code" => 7, "key" => "cancel"]; // 订单取消

    private const OrderStatusArray = [
        OrderStatus::PAY_REQUIRED,
        OrderStatus::DELIVERY_REQUIRED,
        OrderStatus::RECEIVE_REQUIRED,
        OrderStatus::COMMENT_REQUIRED,
        OrderStatus::COMPLETE,
        OrderStatus::CANCEL,
    ];

    /**
     * key 获取
     *
     * @param $key
     * @return mixed
     */
    public static function findByKey($key)
    {
        foreach (OrderStatus::OrderStatusArray as $status) {
            if ($status["key"] === $key) {
                return $status;
            }
        }
    }
}