<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\SkuService;
use App\Http\Service\SpuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SpuMapi extends Controller
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

    public function listByPage(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getPagedSpuList($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建SPU
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->createSpu($req);
        if ($result) return new JsonResult();
    }

    public function detail(Request $request)
    {
    }

    /**
     * SpuMapi constructor.
     * @param SpuService $spuService
     */
    public function __construct(SpuService $spuService)
    {
        $this->spuService = $spuService;
    }
}
