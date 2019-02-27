<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Dao\CollectionDao;
use App\Http\Enum\StatusCode;
use App\Http\Service\SkuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class SkuFapi
 *
 * @package App\Http\Controllers\Fapi
 */
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
     * @return JsonResult
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        return $this->skuService->getSkuById($req);
    }

    /**
     * 通过SPU获取
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listBySpu(Request $request)
    {
        $req = $request->all();
        return $this->skuService->getSkuListBySpuIdEffect($req);
    }

    /**
     * 分类获取
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listByCategory(Request $request)
    {
        $req = $request->all();
        return $this->skuService->getPagedSkuByCategoryEffect($req);
    }

    /**
     * 获取热推商品
     *
     * @return JsonResult
     */
    public function recom()
    {
        return $this->skuService->getRecomSkuList();
    }
//    /**
//     * 规格列表
//     *
//     * @param Request $request
//     * @return JsonResult
//     */
//    public function specList(Request $request)
//    {
//        $req = $request->all();
//        $result = $this->skuService->getSkuSpecListWithOption($req);
//        return new JsonResult(StatusCode::SUCCESS, $result);
//    }

    /**
     * SkuFapi constructor.
     *
     * @param SkuService $skuService
     */
    public function __construct(SkuService $skuService)
    {
        $this->skuService = $skuService;
    }
}
