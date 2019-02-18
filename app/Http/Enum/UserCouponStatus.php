<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/18
 * Time: 16:34
 */

namespace App\Http\Enum;

/**
 * 用户优惠的状态
 *
 * @package App\Http\Enum
 */
class UserCouponStatus
{
    // 未使用的
    const NEW = 1;
    // 使用过的
    const USED = 2;
    // 过期的
    const EXPIRED = 3;
}