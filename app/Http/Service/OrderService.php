<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 13:53
 */

namespace App\Http\Service;


use App\Http\Dao\OrderDao;
use App\Http\Dao\OrderProductDao;

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
     * @var OrderProductDao
     */
    private $orderProductDao;

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
        $productList = $this->orderProductDao->findByOrderId($orderId);
        $result = new \stdClass();
        $result->order = $order;
        $result->productList = $productList;
        return $result;
    }

    /**
     * OrderService constructor.
     *
     * @param OrderDao $orderDao
     * @param OrderProductDao $orderProductDao
     */
    public function __construct(OrderDao $orderDao, OrderProductDao $orderProductDao)
    {
        $this->orderDao = $orderDao;
        $this->orderProductDao = $orderProductDao;
    }
}