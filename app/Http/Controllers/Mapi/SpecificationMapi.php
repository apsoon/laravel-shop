<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\CategoryService;
use App\Http\Service\SpecificationService;
use Illuminate\Http\Request;

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
        return view('admin.pages.goods.specification_add');
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
     * SpecificationMapi constructor.
     *
     * @param SpecificationService $specificationService
     */
    public function __construct(SpecificationService $specificationService)
    {
        $this->middleware('auth');
        $this->specificationService = $specificationService;
    }
}
