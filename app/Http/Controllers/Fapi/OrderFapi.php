<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\OrderService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

class OrderFapi extends Controller
{
    private $orderService;

    /**
     * 创建订单
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->orderService->createOrder($req);
        return $result;
    }

    /**
     * 通过用户获取
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->orderService->getPagedOrderListByStatusUser($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * OrderFapi constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
}
