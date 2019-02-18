<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\OrderService;
use Illuminate\Http\Request;

class OrderMapi extends Controller
{

    private $orderService;

    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->orderService->createOrder($req);
        return $result;
    }

    /**
     * 订单列表
     *
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->orderService->getOrderPagedList($req);
        return $result;
    }

    /**
     * 订单详情
     *
     * @param Request $request
     * @return null|\stdClass
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        if (empty($req) || empty($req["orderId"])) return null;
        $result = $this->orderService->getOrderDetailByOrderId($req["orderId"]);
        return $result;
    }

    /**
     * OrderMapi constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
//        $this->middleware("auth");
        $this->orderService = $orderService;
    }
}
