<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Dao\CollectionDao;
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
     * @var CollectionDao
     */
    private $collectionDao;

    /**
     * 产品详情页
     *
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->getSkuById($req);
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
        $result = $this->skuService->getSkuListBySpuIdEffect($req);
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

    /**
     * 规格列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function specList(Request $request)
    {
        $req = $request->all();
        $result = $this->skuService->getSkuSpecListWithOption($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * SkuFapi constructor.
     *
     * @param SkuService $skuService
     * @param CollectionDao $collectionDao
     */
    public function __construct(SkuService $skuService, CollectionDao $collectionDao)
    {
        $this->skuService = $skuService;
        $this->collectionDao = $collectionDao;
    }
}
