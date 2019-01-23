<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 13:29
 */

namespace App\Http\Dao;


use App\Http\Model\Order;

class OrderDao
{

    /**
     * @var Order
     */
    private $order;

    public function findPagedList(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->order::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 根据id获取
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->order::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * OrderDao constructor.
     *
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}