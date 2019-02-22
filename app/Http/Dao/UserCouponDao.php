<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/18
 * Time: 15:59
 */

namespace App\Http\Dao;


use App\Http\Model\UserCoupon;
use Illuminate\Support\Facades\Log;

class UserCouponDao
{

    /**
     * @var UserCoupon
     */
    private $userCoupon;

    /**
     * 分页状态用户获取
     *
     * @param string $userId
     * @param int $state
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByStateUser(string $userId, int $state, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->userCoupon::where(["user_id" => $userId, "state" => $state])
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 优惠券编号用户获取
     *
     * @param $couponId
     * @param $userId
     * @return mixed
     */
    public function findByCouponUser($couponId, $userId)
    {
        $result = $this->userCoupon::where(["user_id" => $userId, "coupon_id" => $couponId])
            ->get();
        return $result;
    }

    /**
     * UserCouponDao constructor.
     *
     * @param UserCoupon $userCoupon
     */
    public function __construct(UserCoupon $userCoupon)
    {
        $this->userCoupon = $userCoupon;
    }
}