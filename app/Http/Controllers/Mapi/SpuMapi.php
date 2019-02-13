<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\SkuService;
use App\Http\Service\SpuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

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
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取spu
     *
     * @param Request $request
     * @return JsonResult
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getSpuWithDetail($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    public function relateSpec(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->createSpuSpecWithOption($req);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
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
