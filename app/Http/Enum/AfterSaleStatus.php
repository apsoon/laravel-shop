<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/10
 * Time: 10:13
 */

namespace App\Http\Enum;

/**
 * Class AfterSaleStatus
 *
 * @package App\Http\Enum
 */
class AfterSaleStatus
{
    const ACCEPT_REQUIRED = ["code" => 0, "key" => "accept"]; // 待受理
    const COMPLETE = ["code" => 4, "key" => "complete"]; // 已完成
    const CANCEL = ["code" => 7, "key" => "cancel"]; // 订单取消

    private const AfterSaleStatus = [
        AfterSaleStatus::ACCEPT_REQUIRED,
        AfterSaleStatus::COMPLETE,
        AfterSaleStatus::CANCEL,
    ];

    /**
     * key 获取
     *
     * @param $key
     * @return mixed
     */
    public static function findByKey($key)
    {
        foreach (AfterSaleStatus::AfterSaleStatus as $status) {
            if ($status["key"] === $key) {
                return $status;
            }
        }
    }
}