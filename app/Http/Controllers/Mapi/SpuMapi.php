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

    /**
     * @param Request $request
     */
    public function list(Request $request)
    {
    }

    /**
     * @param Request $request
     * @return JsonResult
     */
    public function listByPage(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getPagedSpuList($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取spu对应的spec列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listSpec(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getSpuSpecList($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取规格选项列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listSpecOption(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getSpuSpecListWithOption($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取单个规格的选项
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listOption(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getSpecOptionList($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建选项
     *
     * @param Request $request
     * @return JsonResult
     */
    public function createOption(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->insertSpuSpecOption($req);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
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

    /**
     * spu添加特定的规格及选项
     *
     * @param Request $request
     * @return JsonResult
     */
    public function relateSpec(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->insertSpuSpecList($req);
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
