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
            case 1:
                $this->code = $param[0]["code"];
                $this->message = $param[0]["message"];
                break;
            case 2:
                $this->code = $param[0]["code"];
                $this->message = $param[0]["message"];
                $this->data = $param[1];
                break;
            case 0:
            default:
                $this->code = StatusCode::SUCCESS["code"];
                $this->message = StatusCode::SUCCESS["message"];
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
        if (empty($this->data)) return json_encode(["code" => $this->code, "message" => $this->message], JSON_UNESCAPED_UNICODE);
        else return json_encode(["code" => $this->code, "message" => $this->message, "data" => $this->data], JSON_UNESCAPED_UNICODE);
    }
}