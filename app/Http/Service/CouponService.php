<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 19:03
 */

namespace App\Http\Service;


use App\Http\Dao\CouponDao;
use App\Http\Dao\UserCouponDao;
use App\Http\Model\Coupon;
use App\Http\Model\UserCoupon;
use Illuminate\Support\Facades\Log;
use function PHPSTORM_META\type;

class CouponService
{

    /**
     * @var CouponDao
     */
    private $couponDao;

    /**
     * @var UserCouponDao
     */
    private $userCouponDao;

    /**
     * 创建优惠券
     *
     * @param $req
     * @return bool
     */
    public function createCoupon($req)
    {
        $coupon = new Coupon();
        $coupon->name = $req["name"];
        $coupon->sn = $req["sn"];
        $coupon->describe = $req["describe"];
        $coupon->number = $req["number"];
        Log::info(gettype($req["effectStart"]));
        Log::info($req["effectStart"]);
        if ($req["effectStart"])
            $coupon->effect_start = strtotime($req["effectStart"]);
        if ($req["effectEnd"])
            $coupon->effect_end = strtotime($req["effectEnd"]);
        Log::info(gettype($coupon->effect_start));
        Log::info($coupon->effectStart);
        Log::info($coupon->effect_end);
        $coupon->value = $req["value"];
        $coupon->send_type = $req["sendType"];
        $coupon->state = $req["state"];
        $result = $coupon->save();
        return $result;
    }

    /**
     * 分页获取优惠券列表
     *
     * @param int $pageNo
     * @return mixed
     */
    public function getPagedCouponList(int $pageNo)
    {
        $result = $this->couponDao->findByPage($pageNo, 20);
        return $result;
    }

    public function updateCoupon()
    {
    }

    /**
     * 优惠码获取
     *
     * @param string $code
     * @return mixed
     */
    public function getCouponByCode(string $code)
    {
        $result = $this->couponDao->findByCode($code);
        return $result;
    }

    /**
     * ID 获取
     *
     * @param int $id
     * @return mixed
     */
    public function getCouponById(int $id)
    {
        $result = $this->couponDao->findById($id);
        return $result;
    }

    /**
     * 获取用户不同状态的优惠券
     *
     * @param array $req
     * @return mixed
     */
    public function getPagedCouponListByStateUser(array $req)
    {
        $size = 20;
        $coupons = $this->userCouponDao->findByStateUser($req["userId"], $req["state"], $req["pageNo"], $size);
        foreach ($coupons as $coupon) {
            $detail = $this->couponDao->findById($coupon->couponId);
            $coupon->detail = $detail;
        }
        return $coupons;
    }

    public function addCouponToUser(array $req)
    {
        // 判断coupon 是否存在及数量
        // 判断限领一个的是否已经领取
    }

    /**
     * CouponService constructor.
     *
     * @param CouponDao $couponDao
     * @param UserCouponDao $userCouponDao
     */
    public function __construct(CouponDao $couponDao, UserCouponDao $userCouponDao)
    {
        $this->couponDao = $couponDao;
        $this->userCouponDao = $userCouponDao;
    }
}