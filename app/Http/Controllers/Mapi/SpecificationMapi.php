<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\CategoryService;
use App\Http\Service\SpecificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class SpecificationMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class SpecificationMapi extends Controller
{
    /**
     * @var SpecificationService
     */
    private $specificationService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * 获取规格列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->specificationService->getSpecificationList($req);
        return view('admin.pages.goods.specification_list', ["specifications" => $result]);
    }


    /**
     * 添加规格
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $categoryList = $this->categoryService->getUnitCategory();
        return view('admin.pages.goods.specification_add', ["categoryList" => $categoryList]);
    }

    public function addOption(Request $request)
    {
        $req = $request->all();
        $specification_id = $req["specification_id"];
        return view('admin.pages.goods.specificationOption_add', ["specification_id" => $specification_id]);
    }

    /**
     * 创建
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->specificationService->createSpecification($req);
        if ($result) return redirect("specification/list");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createOption(Request $request)
    {
        $req = $request->all();
        Log::info($req);
        $result = $this->specificationService->createSpecificationOption($req);
        if ($result) return redirect("specification/list");
    }

    /**
     * SpecificationMapi constructor.
     *
     * @param SpecificationService $specificationService
     * @param CategoryService $categoryService
     */
    public function __construct(SpecificationService $specificationService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->specificationService = $specificationService;
        $this->categoryService = $categoryService;
    }
}
