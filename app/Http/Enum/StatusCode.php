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
class StatusCode extends \SplEnum
{
    // 20XX 请求成功
    const SUCCESS = 2000;

    // 40XX 客户端错误
    const PARAM_LACKED = 4001;

    // 50XX 服务端错误
    const SERVER_ERROR = 5001;

    // 80XX 用户相关
    const REGISTER_SUCCESS = 8001;

    const LOGIN_SUCCESS = 8002;

    const WX_CODE_LACKED = 8003;

    const USER_NOT_EXIST = 8004;
}