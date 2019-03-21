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
        return $this->brandService->createBrand($req);
    }

    /**
     * 更新品牌
     *
     * @param Request $request
     * @return JsonResult
     */
    public function update(Request $request)
    {
        $req = $request->all();
        return $this->brandService->updateBrand($req);
    }

    /**
     * 品牌详情
     *
     * @param Request $request
     * @return JsonResult
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        return $this->brandService->getBrandById($req);
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
        return new JsonResult(StatusCode::SERVER_ERROR);
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
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取当前分类下的品牌
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listByCategory(Request $request)
    {
        $req = $request->all();
        return $this->brandService->getBrandByCategory($req);
    }

    /**
     * BrandMapi constructor.
     *
     * @param BrandService $brandService
     */
    public function __construct(BrandService $brandService)
    {
        $this->middleware("auth-mapi");
        $this->brandService = $brandService;
    }
}
