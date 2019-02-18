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
        Log::info(gettype($request->effectStart));
        Log::info($request->effectStart);
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
        $result = $this->couponService->getPagedCouponList($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
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