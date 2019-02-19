<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/19
 * Time: 15:43
 */

namespace App\Http\Util;


class SNUtil
{

    public static function generateOrderSn()
    {
        $orderIdMain = date('YmdHis') . rand(10000000, 99999999);
        $orderIdLen = strlen($orderIdMain);
        $orderIdSum = 0;
        for ($i = 0; $i < $orderIdLen; $i++) {
            $orderIdSum += (int)(substr($orderIdMain, $i, 1));
        }
        $orderId = $orderIdMain . str_pad((100 - $orderIdSum % 100) % 100, 2, '0', STR_PAD_LEFT);
        return $orderId;
    }
}