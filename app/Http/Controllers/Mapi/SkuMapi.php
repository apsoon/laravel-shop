<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\SkuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class SkuMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class SkuMapi extends Controller
{
    /**
     * @var SkuService
     */
    private $skuService;

    public function list(Request $request)
    {
    }

    /**
     * spu id获取sku
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listBySpu(Request $request)
    {
        $req = $request->all();
        return $this->skuService->getSkuBySpu($req);
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
        return $this->skuService->createSku($req);
    }

    public function detail(Request $request)
    {
    }


    /**
     * SkuMapi constructor.
     *
     * @param SkuService $skuService
     */
    public function __construct(SkuService $skuService)
    {
        $this->skuService = $skuService;
    }
}
