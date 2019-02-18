<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\CouponService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

class CouponFapi extends Controller
{
    /**
     * @var CouponService
     */
    private $couponService;

    /**
     * 用户获取优惠券
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        if (empty($req) || empty($req["state"]) || empty($req["pageNo"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->couponService->getPagedCouponListByStateUser($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取优惠券
     *
     * @param Request $request
     * @return JsonResult
     */
    public function add(Request $request)
    {
        $req = $request->all();
        if (empty($req) || empty($req["type"]) || empty($req["couponId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->couponService->addCouponToUser($req);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * CouponFapi constructor.
     *
     * @param CouponService $couponService
     */
    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
}
