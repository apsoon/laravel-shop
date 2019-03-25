<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/25
 * Time: 11:57
 */

namespace App\Http\Util;


/**
 * 预定义的一些工具函数
 */
class OrderUtil
{
    const PAY_API_KEY = 'pay api key';

    public static function getNonceStr()
    {
        $text = "";
        $possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < 16; $i++) {
            $text .= $possible[(int)floor(rand() * strlen($possible))];
        }
        return $text;
    }

    public static function wxSendData($orderSn, $price, $body, $nonceStr, $notifyUrl, $sign, $spbillCreateIp)
    {
        return "<xml>"
            . "<appid>" . env("WX_APP_ID") . "</appid>"
            . "<mch_id>" . env("WX_MERCHANT_ID") . "</mch_id>"
            . "<body>" . $body . "</body>"
            . "<out_trade_no>" . $orderSn . "</out_trade_no>"
            . "<total_fee>" . $price . "</total_fee>"
            . "<trade_type>JSAPI</trade_type>"
            . "<nonce_str>" . $nonceStr . "</nonce_str>"
            . "<notify_url>" . $notifyUrl . "</notify_url>"
            . "<sign>" . $sign . "</sign>"
            . "<spbill_create_ip>" . $spbillCreateIp . "</spbill_create_ip>"
            . "</xml>";
    }

    public static function getPrePaySign($body, $nonceStr, $notifyUrl, $orderSn, $price, $spbillCreateIp)
    {
        $stringA = "appid=" . env("WX_APP_ID")
            . "&body=" . $body
            . "&mch_id=" . env("WX_MERCHANT_ID")
            . "&nonce_str=" . $nonceStr
            . "&notify_url=" . $notifyUrl
            . "&out_trade_no=" . $orderSn
            . "&spbill_create_ip=" . $spbillCreateIp
            . "&total_fee=" . $price
            . "&trade_type=JSAPI";
        $stringSignTemp = $stringA . "&key=" . OrderUtil::PAY_API_KEY;
        return strtoupper(md5($stringSignTemp));
    }

    public static function getPaySign($timeStamp, $nonceStr, $package)
    {
        return strtoupper(MD5("appId=" . env("WX_APP_ID")
            . "&nonceStr=" . $nonceStr
            . "&package=prepay_id=" . $package
            . "&signType=MD5"
            . "&timeStamp=" . $timeStamp
            . "&key=" . OrderUtil::PAY_API_KEY));
    }

    public static function getPayParam($orderSn, $package)
    {
        $result = new \stdClass();
        $result->orderSn = $orderSn;
        $result->signType = 'MD5';
        $timeStamp = date_timestamp_get(date_create());
        $result->timeStamp = $timeStamp;
        $result->nonceStr = OrderUtil::getNonceStr();
        $result->package = $package;
        $result->paySign = OrderUtil::getPaySign($timeStamp, $result->nonceStr, $package);
        return $result;
    }
}