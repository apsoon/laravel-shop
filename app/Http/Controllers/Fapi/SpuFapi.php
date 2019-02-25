<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
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
     * SpuFapi constructor.
     * @param SpuService $spuService
     */
    public function __construct(SpuService $spuService)
    {
        $this->spuService = $spuService;
    }
}
