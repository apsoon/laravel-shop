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

    public static function generateOrderSn()
    {
        $orderIdMain = date('YmdHis') . rand(10000000, 99999999);
        $orderIdLen = strlen($orderIdMain);
        $orderIdSum = 0;
        for ($i = 0; $i < $orderIdLen; $i++) {
            $orderIdSum += (int)(substr($orderIdMain, $i, 1));
        }
        $orderId = $orderIdMain . str_pad((100 - $orderIdSum % 100) % 100, 2, '0', STR_PAD_LEFT);
        return $orderId;
    }

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

    public static function wxPaySendData($openId, $orderSn, $price, $body, $nonceStr, $notifyUrl, $sign, $spbillCreateIp)
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
        return $data;
    }

    public static function wxCancelData()
    {

    }

    public static function wxRefundSendData($nonceStr, $sign, $orderSn, $afterSaleSn, $totalFee, $refundFee, $notifyUrl)
    {
        $data = "<xml>"
            . "<appid>" . env("WX_APP_ID") . "</appid>"
            . "<mch_id>" . env("WX_MERCHANT_ID") . "</mch_id>"
            . "<nonce_str>" . $nonceStr . "</nonce_str>"
            . "<notify_url>" . $notifyUrl . "</notify_url>"
            . "<out_refund_no>" . $afterSaleSn . "</out_refund_no>"
            . "<out_trade_no>" . $orderSn . "</out_trade_no>"
            . "<refund_fee>" . $refundFee . "</refund_fee>"
            . "<total_fee>" . $totalFee . "</total_fee>"
            . "<sign>" . $sign . "</sign>"
            . "</xml>";
        return $data;
    }

    public static function getRefundSign(string $nonceStr, $orderSn, $afterSaleSn, $totalFee, $refundFee, $notifyUrl)
    {
        $stringA = "appid=" . env("WX_APP_ID")
            . "&mch_id=" . env("WX_MERCHANT_ID")
            . "&nonce_str=" . $nonceStr
            . "&notify_url=" . $notifyUrl
            . "out_refund_no" . $afterSaleSn
            . "&out_trade_no=" . $orderSn
            . "&refund_fee=" . $refundFee
            . "&total_fee=" . $totalFee;
        $stringSignTemp = $stringA . "&key=" . env("WX_MERCHANT_KEY");
        $sign = strtoupper(md5($stringSignTemp));
        return $sign;
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
        $stringSignTemp = $stringA . "&key=" . env("WX_MERCHANT_KEY");
        $sign = strtoupper(md5($stringSignTemp));
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
        $result = new \stdClass();
        $result->orderSn = $orderSn;
        $result->signType = 'MD5';
        $timeStamp = date_timestamp_get(date_create());
        $result->timeStamp = $timeStamp;
        $result->nonceStr = OrderUtil::getNonceStr();
        $result->package = "prepay_id=" . $package;
        $result->paySign = OrderUtil::getPaySign($timeStamp, $result->nonceStr, $package);
        return $result;
    }

    /**
     * 生产Sign
     *
     * @param $params
     * @return string
     */
    public static function generateSign($params)
    {
        //签名步骤一：按字典序排序数组参数
        ksort($params);
        $string = OrderUtil::ToUrlParams($params);  //参数进行拼接key=value&k=v
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . env("WX_MERCHANT_KEY");
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }

    static function ToUrlParams($params)
    {
        $string = '';
        if (!empty($params)) {
            $array = array();
            foreach ($params as $key => $value) {
                $array[] = $key . '=' . $value;
            }
            $string = implode("&", $array);
        }
        return $string;
    }
}