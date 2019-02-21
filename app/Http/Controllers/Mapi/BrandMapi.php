<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\BrandService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandMapi extends Controller
{
    /**
     * @var BrandService
     */
    private $brandService;

    /**
     * 获取品牌列表
     *
     * @return JsonResult
     */
    public function list()
    {
        return $this->brandService->getBrandList();
    }

    /**
     * 分页获取品牌列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listByPage(Request $request)
    {
        $req = $request->all();
        return $this->brandService->getPagedBrandList($req);
    }

    /**
     * 创建品牌
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->brandService->createBrand($req);
        if ($result) return new JsonResult();
    }

    /**
     * 修改状态
     *
     * @param Request $request
     * @return JsonResult
     */
    public function modifyState(Request $request)
    {
        $req = $request->all();
        $result = $this->brandService->modifyState($req);
        if ($result) return new JsonResult();
    }

    /**
     * @param Request $request
     * @return JsonResult
     */
    public function delete(Request $request)
    {
        $req = $request->all();
        $result = $this->brandService->deleteBrand($req);
        if ($result) return new JsonResult();
    }

    /**
     * BrandMapi constructor.
     *
     * @param BrandService $brandService
     */
    public function __construct(BrandService $brandService)
    {
//        $this->middleware('auth');
        $this->brandService = $brandService;
    }
}
