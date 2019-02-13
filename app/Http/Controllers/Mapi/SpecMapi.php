<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\CategoryService;
use App\Http\Service\SpecService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class SpecMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class SpecMapi extends Controller
{
    /**
     * @var SpecService
     */
    private $specService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * 获取规格列表
     *
     * @return JsonResult
     */
    public function list()
    {
        $result = $this->specService->getSpecList();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->specService->createSpec($req);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createOption(Request $request)
    {
        $req = $request->all();
        $result = $this->specService->createSpecOption($req);
        if ($result) return url("spec/list");
    }

    /**
     * SpecMapi constructor.
     *
     * @param SpecService $specService
     * @param CategoryService $categoryService
     */
    public function __construct(SpecService $specService, CategoryService $categoryService)
    {
//        $this->middleware('auth');
        $this->specService = $specService;
        $this->categoryService = $categoryService;
    }
}
