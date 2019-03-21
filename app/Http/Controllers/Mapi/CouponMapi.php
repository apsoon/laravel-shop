<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 19:03
 */

namespace App\Http\Controllers\Mapi;


use App\Http\Enum\StatusCode;
use App\Http\Service\CouponService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class CouponMapi
 * @package App\Http\Controllers\Mapi
 */
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
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        return $this->couponService->createCoupon($req);
    }

    /**
     * 优惠券列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        return $this->couponService->getPagedCouponList($req);
    }

    public function changeState(Request $request)
    {

    }

    /**
     * CouponMapi constructor.
     *
     * @param CouponService $couponService
     */
    public function __construct(CouponService $couponService)
    {
        $this->middleware("auth-mapi");
        $this->couponService = $couponService;
    }
}