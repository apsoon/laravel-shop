<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Service\OrderService;
use Illuminate\Http\Request;

class OrderFapi extends Controller
{
    private $orderService;

    //
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->orderService->createOrder($req);
        return $result;
    }

    public function list(Request $request)
    {

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
