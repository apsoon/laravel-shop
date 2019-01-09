<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 11:29
 */

namespace App\Http\Util;


use App\Http\Enum\StatusCode;
use App\Http\Enum\StatusMessage;

class JsonResult
{
    private $code = "";
    private $message = "";
    private $data = "";

    /**
     * JsonResult constructor.
     *
     * StatusCode + StatusMessage
     * StatusCode + StatusMessage + Data
     * 构造函数
     */
    public function __construct()
    {
        $param = func_get_args();
        switch (sizeof($param)) {
            case 2:
                $this->code = $param[0];
                $this->message = $param[1];
                break;
            case 3:
                $this->code = $param[0];
                $this->message = $param[1];
                $this->data = $param[2];
                break;
            case 0:
            default:
                $this->code = StatusCode::SUCCESS;
                $this->message = StatusMessage::SUCCESS;
                break;
        }
    }

    /**
     * toString
     *
     * @return false|string
     */
    public function __toString()
    {
        return json_encode(["code" => $this->code, "message" => $this->message, "data" => $this->data], JSON_UNESCAPED_UNICODE);
    }
}