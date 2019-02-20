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

//    /**
//     * @param Request $request
//     * @return mixed
//     */
//    public function detail(Request $request)
//    {
//        $req = $request->all();
//        $result = $this->spuService->getSpuById($req);
//        return $result;
//    }
//
//    /**
//     * 分类获取
//     *
//     * @param Request $request
//     * @return mixed
//     */
//    public function listByCategory(Request $request)
//    {
//        $req = $request->all();
//        $result = $this->spuService->getPagedSpuByCategoryEffect($req);
//        return $result;
//    }

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
