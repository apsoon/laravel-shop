<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\AfterSaleStatus;
use App\Http\Model\AfterSale;
use App\Http\Service\AfterSaleService;
use Illuminate\Http\Request;

/**
 * Class AfterSaleFapi
 *
 * @package App\Http\Controllers\Fapi
 */
class AfterSaleFapi extends Controller
{
    /**
     * @var AfterSaleService
     */
    private $afterSaleService;

    /**
     * 创建售后
     *
     * @param Request $request
     * @return \App\Http\Util\JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        return $this->afterSaleService->createAfterSale($req);
    }

    /**
     * 取消订单
     *
     * @param Request $request
     * @return \App\Http\Util\JsonResult
     */
    public function cancel(Request $request)
    {
        $req = $request->all();
        return $this->afterSaleService->cancelAfterSale($req);
    }

    /**
     * 分页分状态获取订单
     *
     * @param Request $request
     * @return \App\Http\Util\JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        return $this->afterSaleService->getPagedASListByUserState($req);
    }

    /**
     * AfterSaleFapi constructor.
     *
     * @param AfterSaleService $afterSaleService
     */
    public function __construct(AfterSaleService $afterSaleService)
    {
        $this->afterSaleService = $afterSaleService;
    }
}
