<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\SpuService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SpuFapi extends Controller
{
    /**
     * @var SpuService
     */
    private $spuService;

    /**
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getSpuDetail($req);
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
        $result = $this->spuService->getPagedSpuByCategoryEffect($req);
        return $result;
    }

    public function specList(Request $request)
    {
        $req = $request->all();
        $result = $this->spuService->getSpuSpecListWithOption($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
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
