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
        "code" => "2000",
        "message" => "请求成功"
    ];

    // 40XX 客户端错误
    const PARAM_LACKED = [
        "code" => "4001",
        "message" => "缺少必要参数"
    ];

    // 50XX 服务端错误
    const SERVER_ERROR = [
        "code" => "5001",
        "message" => "内部错误"
    ];

    // 80XX 用户相关
    const REGISTER_SUCCESS = [
        "code" => "8001",
        "message" => "注册成功"
    ];

    const LOGIN_SUCCESS = [
        "code" => "8002",
        "message" => "登录成功"
    ];

    const USER_NOT_EXIST = [
        "code" => "8003",
        "message" => "用户不存在"
    ];

    const WX_CODE_LACKED = [
        "code" => "8004",
        "message" => "缺少微信code"
    ];
}