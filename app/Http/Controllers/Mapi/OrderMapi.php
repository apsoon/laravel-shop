<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\OrderService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class OrderMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class OrderMapi extends Controller
{

    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * 订单列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        return $this->orderService->getOrderPagedListByType($req);
    }

    /**
     * 订单详情
     *
     * @param Request $request
     * @return JsonResult
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        return $this->orderService->getOrderDetailByOrderSn($req);
    }

    /**
     * OrderMapi constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
}
