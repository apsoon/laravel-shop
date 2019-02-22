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
            $order->coutry = $req["coutry"];
            $order->province = $req["province"];
            $order->city = $req["city"];
            $order->conty = $req["conty"];
            $order->address_detail = $req["addressDetail"];
            $order->state = OrderStatus::PAY_REQUIRED;
            $order->create_time = new DateTime();
            // ===================  商品相关
            // ----- 关联sku
            $skuIds = json_decode($req["skuIds"]);
            $skuList = [];
            $originPrice = 0;
            $number = 0;
            foreach ($skuIds as $skuId) {
                // 判断SKU是否存在
                $sku = $this->skuDao->findByIdEffect($skuId->id);
                if (empty($sku)) {
                    return new JsonResult(StatusCode::SKU_NOT_EXIST);
                }
                if ($sku->number <= 0) {
                    return new JsonResult(StatusCode::STOCK_NOT_ENOUGH);
                }
                $this->skuDao->decreaseNumber($sku->id, $sku->number);
                $originPrice += $sku->price * $skuId->number;
                $number += $skuId->number;
                array_push($skuList, ["order_sn" => $order->sn, "sku_id" => $sku->id, "number" => $skuId->number, "name" => $sku->name, "price" => $sku->price]);
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
                if ($order->create_time < $coupon->effect_start || $order->create_time > $coupon->effect_end) {
                    return new JsonResult(StatusCode::COUPON_EXPIRED);
                }
                $price = $originPrice - $coupon->value;
                $couponEffect = true;
            }
            $order->price = $price;
            // =================== 提交订单
            $order->discount = $order->originPrice - $order->price;
            $order->save();
            // ===================
            foreach ($skuList as $sku) {
                $sku["order_id"] = $order->id;
            }
            $this->orderSkuDao->insertList($skuList);
            if ($couponEffect) {
                $this->couponDao->updateStateByIdUser($userId, $couponId, UserCouponStatus::USED);
            }
            DB::commit();
            $result = new \stdClass();
            $result->orderSn = $order->sn;
            return new JsonResult(StatusCode::SUCCESS, $result);
        } catch (\Exception $e) {
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
        if (empty($req["status"])) {
            $result = $this->orderDao->findByUserPaged($req["userId"], $pageNo, $size);
        } else {
            $result = $this->orderDao->findByStatusUserPaged($req["userId"], $req["status"], $pageNo, $size);
        }
        return new JsonResult(StatusCode::SUCCESS, $result);
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
    public
    function getOrderPagedList(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $result = $this->orderDao->findPagedList($pageNo, 20);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取订单详情
     *
     * @param int $orderId
     * @return JsonResult
     */
    public
    function getOrderDetailByOrderId(int $orderId)
    {
        if (empty($req) || empty($req["orderId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findById($orderId);
        $productList = $this->orderSkuDao->findByOrderId($orderId);
        $result = new \stdClass();
        $result->order = $order;
        $result->productList = $productList;
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