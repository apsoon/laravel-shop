<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/12
 * Time: 11:04
 */

namespace App\Http\Service;


use App\Http\Dao\AfterSaleDao;
use App\Http\Dao\OrderDao;
use App\Http\Dao\SkuDao;
use App\Http\Dao\UserDao;
use App\Http\Enum\AfterSaleStatus;
use App\Http\Enum\OrderStatus;
use App\Http\Enum\StatusCode;
use App\Http\Model\AfterSale;
use App\Http\Util\JsonResult;
use App\Http\Util\OrderUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class AfterSaleService
 *
 * @package App\Http\Service
 */
class AfterSaleService
{
    /**
     * @var UserDao
     */
    private $userDao;

    /**
     * @var AfterSaleDao
     */
    private $afterSaleDao;

    /**
     * @var OrderDao
     */
    private $orderDao;

    /**
     * @var SkuDao
     */
    private $skuDao;

    /**
     * 创建售后
     *
     * @param array $req
     * @return JsonResult
     */
    public function createAfterSale(array $req)
    {
        if (empty($req["userId"]) || empty($req["orderSn"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findBySn($req["orderSn"]);
        $exist = $this->afterSaleDao->findByOrderSn($order->sn);
        if (!empty($exist) && ($exist->state != AfterSaleStatus::COMPLETE["code"] || $exist->state != AfterSaleStatus::CANCEL["code"]))
            return new JsonResult(StatusCode::DO_NOT_REPEAT_ORDER);
        if (empty($order) || $order->user_id != $req["userId"] || ($order->state < OrderStatus::COMMENT_REQUIRED["code"]))
            return new JsonResult(StatusCode::PARAM_ERROR);
        $afterSale = new AfterSale();
        $afterSale->sn = OrderUtil::generateOrderSn();
        $afterSale->user_id = $req["userId"];
        $afterSale->order_sn = $req["orderSn"];
        $afterSale->reason = $req["reason"];
        $afterSale->describe = $req["describe"];
        $afterSale->state = AfterSaleStatus::ACCEPT_REQUIRED["code"];
        $result = $this->afterSaleDao->insert($afterSale);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 退款
     *
     * @param array $req
     * @return JsonResult
     */
    public function refundAfterSale(array $req)
    {
        if (empty($req["afterSaleSn"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $afterSaleSn = $req["afterSaleSn"];
        $afterSale = $this->afterSaleDao->findBySn($afterSaleSn);
        $order = $this->orderDao->findBySn($afterSale->order_sn);
        if (empty($afterSale) || $afterSale->state != AfterSaleStatus::ACCEPT_REQUIRED["code"]) {
            return new JsonResult(StatusCode::PARAM_ERROR);
        }
        try {
            $wxResult = $this->createWxRefund($order->orderSn, $afterSaleSn, $order->price);
            if (empty($wxResult)) {
                throw new \Exception("request failed");
            }
            //  加载XML内容
            $resultObj = simplexml_load_string($wxResult, 'SimpleXMLElement', LIBXML_NOCDATA);
            if ($resultObj->return_code != "SUCCESS") {
                throw new \Exception(" return error " . $resultObj->return_msg);
            }
            if ($resultObj->result_code != "SUCCESS") {
                throw new \Exception("result error" . $resultObj->err_code_des);
            }
            // TODO check sign
            $afterSale->state = AfterSaleStatus::REFUNDING;
            $afterSale->save();
            return new JsonResult(StatusCode::SUCCESS);
        } catch (\Exception $e) {
            Log::error(" [ OrderService.php ] =================== payOrder >>>>> pay order failed [ e ] =  ");
            Log::error($e);
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
    }

    private function createWxRefund($orderSn, $afterSaleSn, $price)
    {
        $totalFee = $price * 100;
        $refundFee = $totalFee;
        $nonceStr = OrderUtil::getNonceStr();
        $spbillCreateIp = env("SERVER_IP");
        $notifyUrl = "http://" . $spbillCreateIp . "/after/callback";
        $sign = OrderUtil::getRefundSign($nonceStr, $orderSn, $afterSaleSn, $totalFee, $refundFee, $notifyUrl);
        $requestData = OrderUtil::wxRefundSendData($nonceStr, $sign, $orderSn, $afterSaleSn, $totalFee, $refundFee, $notifyUrl);
        $requestUrl = "https://api.mch.weixin.qq.com/secapi/pay/refund";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        try {
            $result = curl_exec($ch);
            return $result;
        } catch (\Exception $e) {
            Log::error(" [ OrderService.php ] =================== createWxOrder >>>>> create wx order failed [ e ] =  ");
            Log::error($e);
        } finally {
            curl_close($ch);
        }
        return "";
    }

    public function dealWxCallBack(Request $request)
    {
        $wxRequest = trim(file_get_contents("php://input"));
        if (empty($wxRequest)) {
            return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        }
        try {
            libxml_disable_entity_loader(true); //禁止引用外部xml实体
            $xml = simplexml_load_string($wxRequest, 'SimpleXMLElement', LIBXML_NOCDATA); //XML转数组
            $postData = (array)$xml;
            if ($postData["return_code"] != "SUCCESS") {
                throw new \Exception(" return error " . $postData["return_msg"]);
            }
            if ($postData["result_code"] != "SUCCESS") {
                throw new \Exception(" return error " . $postData["err_code_des"]);
            }
            $afterSaleSn = $postData['out_refund_no'];
            $afterSale = $this->afterSaleDao->findBySn($afterSaleSn);
            if (empty($afterSale) || $afterSale->state != AfterSaleStatus::ING["code"]) {
                throw new \Exception(" Order not Exist" . $afterSaleSn);
            }
            $postSign = $postData['sign'];
            unset($postData['sign']);
            $newSign = OrderUtil::generateSign($postData);
            if ($postSign == $newSign) {
                $afterSale->state = AfterSaleStatus::COMPLETE["code"];
                $afterSale->save();
            }
        } catch (\Exception $e) {
            Log::error(" [ AfterSaleService.php ] =================== dealWxCallBack >>>>>  wx callback failed [ e ] =  ");
            Log::error($e);
            return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        }
        return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
    }

    /**
     * 取消售后订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function cancelAfterSale(array $req)
    {
        if (empty($req["afterSaleSn"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $afterSale = $this->afterSaleDao->findBySn($req["afterSaleSn"]);
        if (empty($afterSale) || $afterSale->user_id != $req["userId"]) return new JsonResult(StatusCode::PARAM_ERROR);
        $afterSale->state = AfterSaleStatus::CANCEL["code"];
        $result = $this->afterSaleDao->update($afterSale);
        if ($result) return new JsonResult();
        return new JsonResult();
    }

    /**
     * 分页分状态获取售后订单
     *
     * @return JsonResult
     */
    public function getPagedASListByUserState($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = 20;
        $type = $req["type"];
        if ($type === "all") $result = $this->afterSaleDao->findPagedListByUser($req["userId"], $pageNo, $size);
        else $result = $this->afterSaleDao->findPagedListByStateUser($req["userId"], $req["state"], $pageNo, $size);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 分页分状态获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getAsPagedListByType(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $type = $req["type"];
        $result = new \stdClass();
        if ($type === "all") {
            $afSaleList = $this->afterSaleDao->findPagedList($pageNo, $size);
            $result->total = AfterSale::count();
        } else {
            $state = AfterSaleStatus::findByKey($type)["code"];
            $afSaleList = $this->afterSaleDao->findPagedListByState($state, $pageNo, $size);
            $result->total = AfterSale::where("state", "=", $state)->count();
        }
        foreach ($afSaleList as $afSale) {
            $user = $this->userDao->findByUserId($afSale->user_id);
            $afSale->nickname = $user->nickname;
            $sku = $this->skuDao->findById($afSale->sku_id);
            $afSale->sku_name = $sku->name;
        }
        $result->afSaleList = $afSaleList;
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 修改售后订单状态
     *
     * @param array $req
     * @return JsonResult
     */
    public function updateAfterSaleState(array $req)
    {
        $result = $this->afterSaleDao->updateStateById($req["id"], $req["state"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * AfterSaleService constructor.
     *
     * @param AfterSaleDao $afterSaleDao
     * @param OrderDao $orderDao
     * @param UserDao $userDao
     * @param SkuDao $skuDao
     */
    public function __construct(AfterSaleDao $afterSaleDao, OrderDao $orderDao, UserDao $userDao, SkuDao $skuDao)
    {
        $this->afterSaleDao = $afterSaleDao;
        $this->orderDao = $orderDao;
        $this->userDao = $userDao;
        $this->skuDao = $skuDao;
    }
}