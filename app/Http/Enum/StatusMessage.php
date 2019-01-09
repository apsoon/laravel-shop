<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 13:27
 */

namespace App\Http\Enum;


class StatusMessage extends \SplEnum
{
    // 20XX 请求成功
    const SUCCESS = "请求成功";

    // 40XX 客户端错误
    const PARAM_LACKED = "缺少必要参数";

    // 50XX 服务器错误
    const SERVER_ERROR = "内部错误";

    // 80XX 用户相关
    const REGISTER_SUCCESS = "注册成功";

    const LOGIN_SUCCESS = "登录成功";

    const WX_CODE_LACKED = "缺少微信code";

    const USER_NOT_EXIST = "用户不存在";
}