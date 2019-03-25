<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/25
 * Time: 11:57
 */

namespace App\Http\Util;


use Illuminate\Support\Facades\Log;

/**
 * 预定义的一些工具函数
 */
class OrderUtil
{

    public static function getNonceStr()
    {
//        $text = "";
//        $possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
//        for ($i = 0; $i < 16; $i++) {
//            $text .= $possible[floor(rand() * strlen($possible))];
//        }
//        return $text;
        return strtoupper(md5(date_timestamp_get(date_create()) . "123" . rand() * 10000));
    }

    public static function wxSendData($openId, $orderSn, $price, $body, $nonceStr, $notifyUrl, $sign, $spbillCreateIp)
    {
        $data = "<xml>"
            . "<appid>" . env("WX_APP_ID") . "</appid>"
            . "<body>" . $body . "</body>"
            . "<mch_id>" . env("WX_MERCHANT_ID") . "</mch_id>"
            . "<nonce_str>" . $nonceStr . "</nonce_str>"
            . "<notify_url>" . $notifyUrl . "</notify_url>"
            . "<openid>" . $openId . "</openid>"
            . "<out_trade_no>" . $orderSn . "</out_trade_no>"
            . "<spbill_create_ip>" . $spbillCreateIp . "</spbill_create_ip>"
            . "<total_fee>" . $price . "</total_fee>"
            . "<trade_type>JSAPI</trade_type>"
            . "<sign>" . $sign . "</sign>"
            . "</xml>";
        Log::info(" [ OrderUtil.php ] =================== wxSendData >>>>> data = ");
        Log::info($data);
        return $data;
    }

    public static function getPrePaySign($openId, $body, $nonceStr, $notifyUrl, $orderSn, $price, $spbillCreateIp)
    {
        $stringA = "appid=" . env("WX_APP_ID")
            . "&body=" . $body
            . "&mch_id=" . env("WX_MERCHANT_ID")
            . "&nonce_str=" . $nonceStr
            . "&notify_url=" . $notifyUrl
            . "&openid=" . $openId
            . "&out_trade_no=" . $orderSn
            . "&spbill_create_ip=" . $spbillCreateIp
            . "&total_fee=" . $price
            . "&trade_type=JSAPI";
        Log::info(" [ OrderUtil.php ] =================== getPrePaySign >>>>> ");
        Log::info($stringA);
        $stringSignTemp = $stringA . "&key=" . env("WX_MERCHANT_KEY");
        Log::info(" [ OrderUtil.php ] =================== getPrePaySign >>>>> ");
        Log::info($stringSignTemp);
        $sign = strtoupper(md5($stringSignTemp));
        Log::info(" [ OrderUtil.php ] =================== getPrePaySign >>>>> ");
        Log::info($sign);
        return $sign;
    }

    public static function getPaySign($timeStamp, $nonceStr, $package)
    {
        return strtoupper(MD5("appId=" . env("WX_APP_ID")
            . "&nonceStr=" . $nonceStr
            . "&package=prepay_id=" . $package
            . "&signType=MD5"
            . "&timeStamp=" . $timeStamp
            . "&key=" . env("WX_MERCHANT_KEY")));
    }

    public static function getPayParam($orderSn, $package)
    {
        Log::info(typeOf($package));
        $result = new \stdClass();
        $result->orderSn = $orderSn;
        $result->signType = 'MD5';
        $timeStamp = date_timestamp_get(date_create());
        $result->timeStamp = $timeStamp;
        $result->nonceStr = OrderUtil::getNonceStr();
        Log::info($package);
        $result->package = $package;
        Log::info($result->package);
        $result->paySign = OrderUtil::getPaySign($timeStamp, $result->nonceStr, $package);
        return $result;
    }
}