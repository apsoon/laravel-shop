<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\AttrService;
use App\Http\Service\SpuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class SpuFapi
 *
 * @package App\Http\Controllers\Fapi
 */
class SpuFapi extends Controller
{
    /**
     * @var SpuService
     */
    private $spuService;

    /**
     * @var AttrService
     */
    private $attrService;

    /**
     * 获取SPU详情
     *
     * @param Request $request
     * @return JsonResult
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        return $this->spuService->getSpuDetail($req);
    }

    /**
     * 获取Banner
     *
     * @param Request $request
     * @return JsonResult
     */
    public function bannerList(Request $request)
    {
        $req = $request->all();
        return $this->spuService->getBannerEffectList($req);
    }

    /**
     * spu获取规格列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function specList(Request $request)
    {
        $req = $request->all();
        return $this->spuService->getSpuSpecListWithOption($req);
    }

    /**
     * 获取属性
     *
     * @param Request $request
     * @return JsonResult
     */
    public function attrList(Request $request)
    {
        $req = $request->all();
        return $this->attrService->getSpuGroupedAttrValueList($req);
    }

    /**
     * SpuFapi constructor.
     *
     * @param SpuService $spuService
     * @param AttrService $attrService
     */
    public function __construct(SpuService $spuService, AttrService $attrService)
    {
        $this->middleware("auth-fapi");
        $this->spuService = $spuService;
        $this->attrService = $attrService;
    }
}
