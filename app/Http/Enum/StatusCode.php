<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 11:53
 */

namespace App\Http\Enum;

/**
 * Class StatusCode
 * http请求的返回状态编码
 *
 * @package App\Http\Enum
 */
class StatusCode
{
    // 20XX 请求成功
    const SUCCESS = [
        "code" => 2000,
        "message" => "请求成功"
    ];

    // 40XX 客户端错误
    const PARAM_LACKED = [
        "code" => 4001,
        "message" => "缺少必要参数"
    ];

    const PARAM_ERROR = [
        "code" => 4002,
        "message" => "参数错误"
    ];

    // 50XX 服务端错误
    const SERVER_ERROR = [
        "code" => 5001,
        "message" => "内部错误"
    ];

    // 80XX 用户相关
    const REGISTER_SUCCESS = [
        "code" => 8001,
        "message" => "注册成功"
    ];

    const LOGIN_SUCCESS = [
        "code" => 8002,
        "message" => "登录成功"
    ];

    const USER_NOT_EXIST = [
        "code" => 8003,
        "message" => "用户不存在"
    ];

    const WX_CODE_LACKED = [
        "code" => 8004,
        "message" => "缺少微信code"
    ];

    // 100XX 商品
    const STOCK_NOT_ENOUGH = [
        "code" => 10001,
        "message" => "库存不足"
    ];

    const SKU_NOT_EXIST = [
        "code" => 10002,
        "message" => "商品不存在"
    ];

    // 110XX 文件上传
    const INVALID_FILE = [
        "code" => 11001,
        "message" => "上传文件无效"
    ];

    // 120xx 优惠券
    const COUPON_NOT_EXIST = [
        "code" => 12001,
        "message" => "优惠券不存在"
    ];
    const COUPON_ALREADY_OBTAIN = [
        "code" => 12002,
        "message" => "已领取过当前优惠券"
    ];
    const COUPON_EXPIRED = [
        "code" => 12003,
        "message" => "优惠券已过期"
    ];
    const COUPON_BEEN_USED = [
        "code" => 12004,
        "message" => "优惠券已使用"
    ];
    const COUPON_NOT_REST = [
        "code" => 12005,
        "message" => "优惠券已领完"
    ];
    const COUPON_NOT_REACH = [
        "code" => 12006,
        "message" => "未达到优惠券使用条件"
    ];
}