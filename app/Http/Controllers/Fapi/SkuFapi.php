<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\SkuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SkuFapi extends Controller
{
    /**
     * @var SkuService
     */
    private $skuService;

    /**
     * 产品详情页
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->getSkuDetail($req);
        return $result;
    }

    /**
     * 通过SPU获取
     *
     * @param Request $request
     * @return mixed
     */
    public function listBySpu(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->getSpuBySpuIdEffect($req);
        return $result;
    }

    /**
     * 分类获取
     *
     * @param Request $request
     * @return mixed
     */
    public function listByCategory(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->getPagedSkuByCategoryEffect($req);
        return $result;
    }

    public function specList(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->getSkuSpecListWithOption($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * SkuFapi constructor.
     * @param SkuService $skuService
     */
    public function __construct(SkuService $skuService)
    {
        $this->skuService = $skuService;
    }
}
