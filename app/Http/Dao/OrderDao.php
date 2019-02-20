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
     * 计算每种每种状态的数量
     *
     * @param string $userId
     * @param array $statusList
     * @return mixed
     */
    public function countStatusByUserId(string $userId, array $statusList)
    {
        $result = $this->order::select("status", "count(order_id)")
            ->where(["user_id" => $userId])
            ->whereIn("status", $statusList)
            ->groupBy("status")
            ->get();
        return $result;
    }

    /**
     * 用户状态分页获取
     *
     * @param $userId
     * @param $status
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByStatusUserPaged($userId, $status, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->order::where(["user_id" => $userId, "status" => $status])
            ->offset($offset)
            ->limit($size)
            ->get();
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