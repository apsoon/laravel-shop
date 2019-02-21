<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 19:03
 */

namespace App\Http\Dao;


use App\Http\Model\Coupon;

class CouponDao
{
    /**
     * @var Coupon
     */
    private $coupon;

    /**
     * 添加
     *
     * @param Coupon $coupon
     * @return bool
     */
    public function insert(Coupon $coupon)
    {
        $result = $coupon->save();
        return $result;
    }

    /**
     * id获取
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->coupon::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * 优惠码获取
     *
     * @param int $code
     * @return mixed
     */
    public function findByCode(int $code)
    {
        $result = $this->coupon::where(["code" => $code])
            ->first();
        return $result;
    }

    /**
     * 分页获取
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->coupon::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * id 用户获取
     *
     * @param $userId
     * @param $couponId
     * @return mixed
     */
    public function findByIdUser($userId, $couponId)
    {
        $result = $this->coupon::where(["user_id" => $userId, "id" => $couponId])
            ->first();
        return $result;

    }

    /**
     * 跟新用户优惠券状态
     *
     * @param $userId
     * @param int $couponId
     * @param $status
     * @return mixed
     */
    public function updateStateByIdUser($userId, int $couponId, $status)
    {
        $result = $this->coupon::where(["user_id" => $userId, "id" => $couponId])
            ->update("status", $status);
        return $result;
    }

    /**
     * 减少优惠券的数量
     *
     * @param $couponId
     * @param $number
     * @return mixed
     */
    public function decreaseNumber($couponId, $number)
    {
        $result = $this->coupon::where("id", "=", $couponId)
            ->decrement("number", $number);
        return $result;
    }

    /**
     * CouponDao constructor.
     *
     * @param Coupon $coupon
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }
}