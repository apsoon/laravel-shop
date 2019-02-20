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
        // TODO : HALF
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
            // ===================  商品相关
            // ----- 关联sku
            $skuIds = json_decode($req["skuIds"]);
            $skuList = [];
            $originPrice = 0;
            $number = 0;
            $price = 0;
            foreach ($skuIds as $skuId) {
                // 判断SKU是否存在
                $sku = $this->skuDao->findByIdEffect($skuId->id);
                if ($sku && $sku->number) {
                    $this->skuDao->updateNumber($sku->id, $sku->number - 1);
                    $originPrice += $sku->price * $skuId->number;
                    $number += $skuId->number;
                    array_push($skuList, ["order_sn" => $order->sn, "sku_id" => $sku->id, "number" => $skuId->number, "name" => $sku->name, "price" => $sku->price]);
                }
            }
            $order->origin_price = $originPrice;
            // ===================  优惠券相关
            // ------ 优惠券
            $couponId = "";
            if ($req["useCoupon"]) {
                $couponId = $req["couponId"];
                $coupon = $this->couponDao->findByIdUser($userId, $couponId);
                // 判断优惠券使用
                if ($coupon) {
                    $couponEffect = true;
//            $order->price
                }
            }
            $orderSave = $order->save();
            $skuSave = false;
            $couponUpdate = !$couponEffect;
            if ($orderSave) {
                foreach ($skuList as $sku) {
                    $sku["order_id"] = $order->id;
                }
                $skuSave = $this->orderSkuDao->insertList($skuList);
                if ($couponEffect) {
                    $couponUpdate = $this->couponDao->updateStateByIdUser($userId, $couponId, UserCouponStatus::USED);
                }
            }
            $result = $orderSave && $skuSave && $couponUpdate;
            if (!$result) {
                DB::rollBack();
            }
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
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
    public function getOrderStatusNumberByUser(array $req)
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
     * @param int $orderId
     * @return JsonResult
     */
    public function getOrderDetailByOrderId(int $orderId)
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
    public function __construct(OrderDao $orderDao, SkuDao $skuDao, OrderSkuDao $orderSkuDao, CouponDao $couponDao)
    {
        $this->orderDao = $orderDao;
        $this->skuDao = $skuDao;
        $this->orderSkuDao = $orderSkuDao;
        $this->couponDao = $couponDao;
    }
}