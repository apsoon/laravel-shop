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
        "key" => "user_receive"
    ];
    // 后台发放
    const SYSTEM_SEND = [
        "code" => 2,
        "key" => "system_send"
    ];
    // 口令获取
    const PASSWORD = [
        "code" => 3,
        "key" => "password"
    ];
}