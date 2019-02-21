<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/21
 * Time: 16:01
 */

namespace App\Http\Enum;


class CouponSendType
{
    // 用户领取
    const USER_RECEIVE = [
        "code" => 1,
        "key" => "USER_RECEIVE "
    ];
    // 后台发放
    const SYSTEM_SEND = [
        "code" => 2,
        "key" => "SYSTEM_SEND "
    ];
    // 代码获取
    const SN = [
        "code" => 3,
        "key" => "SN "
    ];
}