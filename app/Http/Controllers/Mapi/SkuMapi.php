<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\SkuService;
use App\Http\Service\SpuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

class SkuMapi extends Controller
{
    /**
     * @var SpuService
     */
    private $spuService;

    /**
     * @var SkuService
     */
    private $skuService;

    public function list(Request $request)
    {
    }

    /**
     * spu id获取sku
     * @param Request $request
     * @return JsonResult
     */
    public function listBySpu(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->getSkuBySpu($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建Sku
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->createSku($req);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    public function detail(Request $request)
    {
    }


    public function __construct(SpuService $spuService, SkuService $skuService)
    {
        $this->spuService = $spuService;
        $this->skuService = $skuService;
    }
}
