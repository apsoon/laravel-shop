<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 19:03
 */

namespace App\Http\Controllers\Mapi;


use App\Http\Service\CouponService;
use Illuminate\Http\Request;

class CouponMapi
{

    /**
     * @var CouponService
     */
    private $couponService;

    /**
     * 创建优惠券
     *
     * @param Request $request
     * @return bool
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->couponService->createCoupon($req);
        return $result;
    }

    /**
     * 优惠券列表
     *
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $pageNo = empty($req) || empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $result = $this->couponService->getPagedCouponList($pageNo);
        return $result;
    }

    public function changeState(Request $request)
    {

    }


    /**
     * CouponMapi constructor.
     *
     * @param CouponService $couponService
     */
    public
    function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
}