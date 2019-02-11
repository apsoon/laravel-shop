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
        $result = $this->brandService->getBrandList();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 分页获取品牌列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listByPage(Request $request)
    {
        $info = $request->all();
        $result = $this->brandService->getPagedBrandList($info);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建品牌
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createBrand(Request $request)
    {
        $req = $request->all();
        $result = $this->brandService->createBrand($req);
        if ($result) return redirect("brand/list");
    }

    /**
     * BrandMapi constructor.
     *
     * @param BrandService $brandService
     */
    public function __construct(BrandService $brandService)
    {
        $this->middleware('auth');
        $this->brandService = $brandService;
    }
}
