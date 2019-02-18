<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 13:53
 */

namespace App\Http\Service;


use App\Http\Dao\OrderDao;
use App\Http\Dao\OrderSkuDao;
use App\Http\Enum\OrderStatus;

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
     * @var OrderSkuDao
     */
    private $orderSkuDao;

    public function createOrder(array $req)
    {
        // 事务
        // 创建订单
        // 关联sku
        // 优惠券条件
    }

    /**
     *
     * @param array $req
     * @return mixed
     */
    public function getOrderPagedListByStatus(array $req)
    {
        $pageNo = $req["pageNo"];
        $size = 20;
        $result = $this->orderDao->find(Sreq["userId"], $req["status"], $pageNo, $size);
        return $result;
    }

    /**
     * 统计用户每种状态订单的数量
     *
     * @param array $req
     * @return mixed
     */
    public function getOrderNumber(array $req)
    {
        $userId = $req["userId"];
        $statusList = [OrderStatus::PAY_REQUIRED, OrderStatus::DELIVERY_REQUIRED, OrderStatus::RECEIVE_REQUIRED, OrderStatus::COMMENT_REQUIRED];
        $result = $this->orderDao->countStatusByUserId($userId, $statusList);
        return $result;
    }

    /**
     * 分页获取订单
     *
     * @param array $req
     * @return mixed
     */
    public function getOrderPagedList(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $result = $this->orderDao->findPagedList($pageNo, 20);
        return $result;
    }

    /**
     * 获取订单详情
     *
     * @param int $orderId
     * @return \stdClass
     */
    public function getOrderDetailByOrderId(int $orderId)
    {
        $order = $this->orderDao->findById($orderId);
        $productList = $this->orderSkuDao->findByOrderId($orderId);
        $result = new \stdClass();
        $result->order = $order;
        $result->productList = $productList;
        return $result;
    }

    /**
     * OrderService constructor.
     *
     * @param OrderDao $orderDao
     * @param OrderSkuDao $orderSkuDao
     */
    public function __construct(OrderDao $orderDao, OrderSkuDao $orderSkuDao)
    {
        $this->orderDao = $orderDao;
        $this->orderSkuDao = $orderSkuDao;
    }
}