<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\OrderService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class OrderFapi
 *
 * @package App\Http\Controllers\Fapi
 */
class OrderFapi extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * 创建订单
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        return $this->orderService->createOrder($req);
    }

    /**
     * 取消订单
     *
     * @param Request $request
     * @return JsonResult
     */
    public function cancel(Request $request)
    {
        $req = $request->all();
        return $this->orderService->cancelOrder($req);
    }

    /**
     * 支付订单
     *
     * @param Request $request
     * @return JsonResult
     * @throws \Exception
     */
    public function pay(Request $request)
    {
        $req = $request->all();
        return $this->orderService->payOrder($req);
    }

    /**
     * 确认收货
     *
     * @param Request $request
     * @return JsonResult
     */
    public function receive(Request $request)
    {
        $req = $request->all();
        return $this->orderService->receiveOrder($req);
    }

    /**
     * 微信订单调用
     *
     * @param Request $request
     * @return JsonResult
     */
    public function wxCallBack(Request $request)
    {
        return $this->orderService->dealWxCallBack($request);
    }

    /**
     * 删除订单
     *
     * @param Request $request
     * @return JsonResult
     */
    public function delete(Request $request)
    {
        $req = $request->all();
        return $this->orderService->deleteOrder($req);
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
        return $this->orderService->getPagedOrderListByStatusUser($req);
    }


    /**
     * 获取每种状态的订单数量
     *
     * @param Request $request
     * @return JsonResult
     */
    public function number(Request $request)
    {
        $req = $request->all();
        return $this->orderService->getOrderStatusNumberByUser($req);
    }

    /**
     * OrderFapi constructor.
     *
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->middleware("auth-fapi");
        $this->orderService = $orderService;
    }
}
