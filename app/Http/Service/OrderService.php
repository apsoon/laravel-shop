<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 13:53
 */

namespace App\Http\Service;


use App\Http\Dao\CouponDao;
use App\Http\Dao\OrderDao;
use App\Http\Dao\OrderSkuDao;
use App\Http\Dao\SkuDao;
use App\Http\Dao\UserCouponDao;
use App\Http\Dao\UserDao;
use App\Http\Enum\CouponSendType;
use App\Http\Enum\OrderStatus;
use App\Http\Enum\StatusCode;
use App\Http\Enum\UserCouponStatus;
use App\Http\Model\Order;
use App\Http\Util\JsonResult;
use App\Http\Util\OrderUtil;
use App\Http\Util\SNUtil;
use function Composer\Autoload\includeFile;
use DateTime;
use DOMDocument;
use function GuzzleHttp\Promise\all;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class OrderService
 *
 * @package App\Http\Service
 */
class OrderService
{
    /**
     * @var OrderDao
     */
    private $orderDao;

    /**
     * @var SkuDao
     */
    private $skuDao;
    /**
     * @var OrderSkuDao
     */
    private $orderSkuDao;

    /**
     * @var CouponDao
     */
    private $couponDao;

    /**
     * @var UserDao
     */
    private $userDao;

    /**
     * @var UserCouponDao
     */
    private $userCouponDao;

    /**
     * 创建订单
     *
     * @param array $req
     * @return mixed
     */
    public function createOrder(array $req)
    {
        $userId = $req["userId"];
        // 事务
        // 创建订单
        DB::beginTransaction();
        try {
            $couponEffect = false;
            $order = new Order();
            // ===================  订单相关
            $order->user_id = $userId;
            $order->sn = OrderUtil::generateOrderSn();
            $order->consignee = $req["consignee"];
            $order->phone = $req["phone"];
            $order->post_code = $req["postCode"];
            $order->country = $req["country"];
            $order->province = $req["province"];
            $order->city = $req["city"];
            $order->county = $req["county"];
            $order->address_detail = $req["addressDetail"];
            $order->state = OrderStatus::PAY_REQUIRED["code"];
            $order->create_time = new DateTime();
            // ===================  商品相关
            // ----- 关联sku
            $requestSkus = json_decode($req["skuIds"]);
            $skuList = [];
            $originPrice = 0;
            $number = 0;
            foreach ($requestSkus as $requestSku) {
                // 请求数量判断
                if ($requestSku->number <= 0) {
                    return new JsonResult(StatusCode::PARAM_ERROR);
                }
                // 判断SKU是否存在
                $sku = $this->skuDao->findByIdEffect($requestSku->id);
                if (empty($sku)) {
                    return new JsonResult(StatusCode::SKU_NOT_EXIST);
                }
                // 库存数量判断
                if ($sku->number < $requestSku->number) {
                    return new JsonResult(StatusCode::STOCK_NOT_ENOUGH);
                }
                $this->skuDao->decreaseNumber($sku->id, $requestSku->number); // TODO ? position
                $originPrice += $sku->price * $requestSku->number;
                $number += $requestSku->number;
                array_push($skuList, ["order_sn" => $order->sn, "sku_id" => $sku->id, "number" => $requestSku->number, "image_url" => $sku->image_url,
                    "name" => $sku->name, "price" => $sku->price, "total" => $sku->price * $requestSku->number]);
            }
            $order->origin_price = $originPrice;
            $order->number = $number;
            // ===================  优惠券相关
            // ------ 优惠券
            $price = $originPrice;
            $couponId = "";
            if ($req["useCoupon"]) {
                $couponId = $req["couponId"];
                // 用户优惠券校验
                $userCoupon = $this->userCouponDao->findByCouponUser($userId, $couponId);
                if (empty($userCoupon)) {
                    return new JsonResult(StatusCode::COUPON_NOT_EXIST);
                }
                if ($userCoupon->state != UserCouponStatus::NEW) {
                    switch ($userCoupon->state) {
                        case UserCouponStatus::USED:
                            return new JsonResult(StatusCode::COUPON_BEEN_USED);
                            break;
                        case UserCouponStatus::EXPIRED:
                            return new JsonResult(StatusCode::COUPON_EXPIRED);
                            break;
                    }
                }
                // 优惠券校验
                $coupon = $this->couponDao->findById($couponId);
                // 是否在有效期内
                if ($order->create_time < $coupon->effect_start || $order->create_time > $coupon->effect_end) {
                    return new JsonResult(StatusCode::COUPON_EXPIRED);
                }
                // 是否金额限制
                if ($coupon->is_usage_limit && $originPrice < $coupon->usage_value) {
                    return new JsonResult(StatusCode::COUPON_NOT_REACH);
                }
                // 折扣类型
                if ($coupon->discount_type == 1) {
                    $price = $originPrice - $coupon->value;
                } else if ($coupon->discout_type == 2) {
                    $price = $originPrice * $coupon->discount;
                }
                $couponEffect = true;
            }
            $order->price = $price;
            // =================== 提交订单
            $order->discount = $order->origin_price - $order->price;
            $order->save();
            // ===================
            $this->orderSkuDao->insertList($skuList);
            if ($couponEffect) {
                $this->couponDao->updateStateByIdUser($userId, $couponId, UserCouponStatus::USED);
            }
            // =================== 请求微信接口
            DB::commit();
            $result = new \stdClass();
            $result->orderSn = $order->sn;
            return new JsonResult(StatusCode::SUCCESS, $result);
        } catch (\Exception $e) {
            Log::error(" [ OrderService.php ] =================== createOrder >>>>> create order failed [ e ] =  ");
            Log::error($e);
            DB::rollBack();
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
    }

    /**
     * 支付订单
     *
     * @param array $req
     * @return JsonResult
     * @throws \Exception
     */
    public function payOrder(array $req)
    {
        if (empty($req["orderSn"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $orderSn = $req["orderSn"];
        $order = $this->orderDao->findBySn($orderSn);
        $user = $this->userDao->findByUserId($req["userId"]);
        if (empty($order) || $order->state != OrderStatus::PAY_REQUIRED["code"] || $user->id != $req["userId"]) {
            return new JsonResult(StatusCode::PARAM_ERROR);
        }
        try {
            $wxResult = $this->createWxOrder($orderSn, $order->price, $user->open_id);
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
            $package = json_decode(json_encode($resultObj))->prepay_id;
            $result = OrderUtil::getPayParam($orderSn, $package);
            return new JsonResult(StatusCode::SUCCESS, $result);
        } catch (\Exception $e) {
            Log::error(" [ OrderService.php ] =================== payOrder >>>>> pay order failed [ e ] =  ");
            Log::error($e);
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
    }

    /**
     * 创建微信订单
     *
     * @param $orderSn
     * @param $price
     * @param $openId
     * @return mixed|string
     */
    private function createWxOrder($orderSn, $price, $openId)
    {
        $priceFen = $price * 100;
        $spbillCreateIp = env("SERVER_IP");
        $notifyUrl = "http://" . $spbillCreateIp . "/api/order/callback";
        $body = "pay test";
        $nonceStr = OrderUtil::getNonceStr();
        $sign = OrderUtil::getPrePaySign($openId, $body, $nonceStr, $notifyUrl, $orderSn, $priceFen, $spbillCreateIp);
        $requestData = OrderUtil::wxPaySendData($openId, $orderSn, $priceFen, $body, $nonceStr, $notifyUrl, $sign, $spbillCreateIp);
        $requestUrl = "https://api.mch.weixin.qq.com/pay/unifiedorder";
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

    /**
     * 取消微信订单
     */
    private function cancelWxOrder()
    {

    }

    /**
     * 微信支付回调
     *
     * @param $request
     * @return JsonResult|string
     */
    public function dealWxCallBack($request)
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
            $orderSn = $postData['out_trade_no'];
            $order = $this->orderDao->findBySn($orderSn);
            if (empty($order) || $order->state != OrderStatus::PAY_REQUIRED["code"]) {
                throw new \Exception(" Order not Exist" . $orderSn);
            }
            $postSign = $postData['sign'];
            unset($postData['sign']);
            $newSign = OrderUtil::generateSign($postData);
            if ($postSign == $newSign) {
                $order->state = OrderStatus::DELIVERY_REQUIRED["code"];
                $order->save();
            }
        } catch (\Exception $e) {
            Log::error(" [ OrderService.php ] =================== dealWxCallBack >>>>>  wx callback failed [ e ] =  ");
            Log::error($e);
            return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
        }
        return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
    }

    /**
     * 取消订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function cancelOrder(array $req)
    {
        $orderSn = $req["orderSn"];
        if (empty($orderSn)) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findBySn($orderSn);
        if (empty($order) || $order->user_id != $req["userId"] || $order->state != OrderStatus::PAY_REQUIRED["code"]) return new JsonResult(StatusCode::PARAM_ERROR);
        DB::beginTransaction();
        try {
            // 释放SKU
            $orderSkus = $this->orderSkuDao->findByOrderSn($orderSn);
            foreach ($orderSkus as $orderSku) {
                $this->skuDao->increaseNumber($orderSku->sku_id, $orderSku->number);
            }
            // 如果使用了优惠券，返还优惠券
            if ($order->use_coupon) {
                $coupon = $this->couponDao->findById($order->coupon_id);
                $userCoupon = $this->userCouponDao->findByCouponUser($req["userId"], $coupon->id);
                // 判断是否失效
                $date = new DateTime();
                if ($date->getTimestamp() > $coupon->effect_end) {
                    $userCoupon->state = UserCouponStatus::EXPIRED;
                } else {
                    $userCoupon->state = UserCouponStatus::NEW;
                }
                $this->userCouponDao->update($userCoupon);
            }
            $order->state = OrderStatus::CANCEL["code"];
            $order->save();
            DB::commit();
        } catch (\Exception $e) {
            Log::error(" [ OrderService ] ===================== cancelOrder >>>>>> error happened when cancel a order ");
            Log::error($e);
            DB::rollBack();
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
        return new JsonResult();
    }

    /**
     * 删除订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function deleteOrder(array $req)
    {
        $orderSn = $req["orderSn"];
        if (empty($orderSn)) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findBySn($orderSn);
        if (empty($order) || $order->user_id != $req["userId"] || $order->state < OrderStatus::COMPLETE["code"]) return new JsonResult(StatusCode::PARAM_ERROR);
        $result = $this->orderDao->delete($orderSn);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 用户分页状态获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getPagedOrderListByStatusUser(array $req)
    {
        if (empty($req["userId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = 20;
        if ($req["type"] == "all") {
            $orders = $this->orderDao->findByUserPaged($req["userId"], $pageNo, $size);
        } else {
            $orders = $this->orderDao->findByStatusUserPaged($req["userId"], $req["state"], $pageNo, $size);
        }
        foreach ($orders as $order) {
            $order->skus = $this->orderSkuDao->findByOrderSn($order->sn);
        }
        return new JsonResult(StatusCode::SUCCESS, $orders);
    }

    /**
     * 统计用户每种状态订单的数量
     *
     * @param array $req
     * @return JsonResult
     */
    public
    function getOrderStatusNumberByUser(array $req)
    {
        $userId = $req["userId"];
        $statusList = [OrderStatus::PAY_REQUIRED, OrderStatus::DELIVERY_REQUIRED, OrderStatus::RECEIVE_REQUIRED, OrderStatus::COMMENT_REQUIRED];
        $result = $this->orderDao->countStatusByUserId($userId, $statusList);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 分页分状态获取订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function getOrderPagedListByType(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $type = $req["type"];
        $result = new \stdClass();
        if ($type === "all") {
            $result->orderList = $this->orderDao->findPagedList($pageNo, $size);
            $result->total = Order::count();
        } else {
            $state = OrderStatus::findByKey($type)["code"];
            $result->orderList = $this->orderDao->findPagedListByState($state, $pageNo, $size);
            $result->total = Order::where("state", "=", $state)->count();
        }
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取订单详情
     *
     * @param array $req
     * @return JsonResult
     */
    public function getOrderDetailByOrderSn(array $req)
    {
        if (empty($req["orderSn"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findBySn($req["orderSn"]);
        $skuList = $this->orderSkuDao->findByOrderSn($req["orderSn"]);
        $result = new \stdClass();
        $result->order = $order;
        $result->skuList = $skuList;
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 发货
     * @param array $req
     * @return JsonResult
     */
    public function postOrder(array $req)
    {
        if (empty($req["orderSn"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findBySn($req["orderSn"]);
        if (empty($order) || $order->state != OrderStatus::DELIVERY_REQUIRED["code"]) return new JsonResult(StatusCode::PARAM_ERROR);
        $order->express_number = $req["expressNumber"];
        $order->state = OrderStatus::RECEIVE_REQUIRED["code"];
        if ($order->save()) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * OrderService constructor.
     *
     * @param OrderDao $orderDao
     * @param SkuDao $skuDao
     * @param OrderSkuDao $orderSkuDao
     * @param CouponDao $couponDao
     * @param UserDao $userDao
     * @param UserCouponDao $userCouponDao
     */
    public function __construct(OrderDao $orderDao, SkuDao $skuDao, OrderSkuDao $orderSkuDao, CouponDao $couponDao, UserDao $userDao, UserCouponDao $userCouponDao)
    {
        $this->orderDao = $orderDao;
        $this->skuDao = $skuDao;
        $this->orderSkuDao = $orderSkuDao;
        $this->couponDao = $couponDao;
        $this->userDao = $userDao;
        $this->userCouponDao = $userCouponDao;
    }
}