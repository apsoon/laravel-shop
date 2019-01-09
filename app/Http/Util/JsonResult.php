<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 11:29
 */

namespace App\Http\Util;


class JsonResult
{
    private $code = "";
    private $message = "";
    private $data = "";

    public function __construct($code, $message, $data)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public function __construct2($code, $message)
    {
        $this->__construct($code, $message, "");
    }

//    public function __construct1($code, $data)
//    {
//$this->code = $code;
//    }

//    public function __construct3($code)
//    {
//
//    }

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