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
use App\Http\Enum\OrderStatus;
use App\Http\Enum\StatusCode;
use App\Http\Enum\UserCouponStatus;
use App\Http\Model\Order;
use App\Http\Util\JsonResult;
use App\Http\Util\SNUtil;
use DateTime;
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
     * 创建订单
     *
     * @param array $req
     * @return mixed
     */
    public function createOrder(array $req)
    {
        // 事务
        // 创建订单
        DB::beginTransaction();
        try {
            $userId = $req["userId"];
            $couponEffect = false;
            $order = new Order();
            // ===================  订单相关
            $order->user_id = $userId;
            $order->sn = SNUtil::generateOrderSn();
            $order->consignee = $req["consignee"];
            $order->phone = $req["phone"];
            $order->post_code = $req["postCode"];
            $order->country = $req["country"];
            $order->province = $req["province"];
            $order->city = $req["city"];
            $order->county = $req["county"];
            $order->address_detail = $req["addressDetail"];
            $order->state = OrderStatus::PAY_REQUIRED;
            $order->create_time = new DateTime();
            // ===================  商品相关
            // ----- 关联sku
            $requestSkus = json_decode($req["skuIds"]);
//            $skuIds = $req["skuIds"];
            Log::info($requestSkus);
            $skuList = [];
//            $skuDecreaseList = [];
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
                Log::info($sku);
//                array_push($skuDecreaseList, $sku);
                $this->skuDao->decreaseNumber($sku->id, $requestSku->number); // TODO ? position
                $originPrice += $sku->price * $requestSku->number;
                $number += $requestSku->number;
                array_push($skuList, ["order_sn" => $order->sn, "sku_id" => $sku->id, "number" => $requestSku->number, "name" => $sku->name, "price" => $sku->price, "total" => $sku->price * $requestSku->number]);
            }
            $order->origin_price = $originPrice;
            // ===================  优惠券相关
            // ------ 优惠券
            $price = $originPrice;
            $couponId = "";
            if ($req["useCoupon"]) {
                $couponId = $req["couponId"];
                // 用户优惠券校验
                $userCoupon = $this->couponDao->findByIdUser($userId, $couponId);
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
            DB::commit();
            $result = new \stdClass();
            $result->orderSn = $order->sn;
            return new JsonResult(StatusCode::SUCCESS, $result);
        } catch (\Exception $e) {
            Log::info(" [ OrderService.php ] =================== createOrder >>>>> create order failed [ e ] =  ");
            Log::info($e);
            DB::rollBack();
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
    }

    /**
     * 用户分页状态获取
     *
     * @param array $req
     * @return JsonResult
     */
    public
    function getPagedOrderListByStatusUser(array $req)
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
     * 分页获取订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function getOrderPagedList(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $result = $this->orderDao->findPagedList($pageNo, 20);
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
     * OrderService constructor.
     *
     * @param OrderDao $orderDao
     * @param SkuDao $skuDao
     * @param OrderSkuDao $orderSkuDao
     * @param CouponDao $couponDao
     */
    public
    function __construct(OrderDao $orderDao, SkuDao $skuDao, OrderSkuDao $orderSkuDao, CouponDao $couponDao)
    {
        $this->orderDao = $orderDao;
        $this->skuDao = $skuDao;
        $this->orderSkuDao = $orderSkuDao;
        $this->couponDao = $couponDao;
    }
}