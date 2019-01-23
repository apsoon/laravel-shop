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