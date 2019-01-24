<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 19:03
 */

namespace App\Http\Service;


use App\Http\Dao\CouponDao;
use App\Http\Model\Coupon;

class CouponService
{

    /**
     * @var CouponDao
     */
    private $couponDao;

    /**
     * 创建优惠券
     *
     * @param $req
     * @return bool
     */
    public function createCoupon($req)
    {
        $coupon = new Coupon();
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
     * CouponService constructor.
     *
     * @param CouponDao $couponDao
     */
    public function __construct(CouponDao $couponDao)
    {
        $this->couponDao = $couponDao;
    }
}