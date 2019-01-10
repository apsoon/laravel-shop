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
    const PAY_REQUIRED = 0; // 待付款
    const DELIVERY_REQUIRED = 1; // 待发货
    const RECEIVE_REQUIRED = 2; // 待收货
    const COMMENT_REQUIRED = 3; // 待评论
    const COMPLETE = 4; // 订单完成
    const CANCEL = 7; // 订单取消
}