<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\AttributeService;
use App\Http\Service\CategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttributeMapi extends Controller
{
    /**
     * @var AttributeService
     */
    private $attributeService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * 获取属性列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->attributeService->getAttributeList($req);
        return view('admin.pages.goods.attribute_list', ["attributes" => $result]);
    }

    /**
     * 添加属性
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function add()
    {
        $groupList = $this->attributeService->getAttributeGroupList();
        return view("admin.pages.goods.attribute_add", ["groupList" => $groupList]);
    }

    /**
     * 添加分组
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function addGroup()
    {
        $categoryList = $this->categoryService->getUnitCategory();
        return view("admin.pages.goods.attributeGroup_add", ["categoryList" => $categoryList]);
    }

    /**
     * 创建属性
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->attributeService->createAttribute($req);
        if ($result) return redirect("attribute/list");
    }

    /**
     * 创建属性组
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createGroup(Request $request)
    {
        $req = $request->all();
        $result = $this->attributeService->createAttributeGroup($req);
        if ($result) return redirect("attribute/list");
    }

    /**
     * AttributeMapi constructor.
     * @param AttributeService $attributeService
     * @param CategoryService $categoryService
     */
    public function __construct(AttributeService $attributeService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->attributeService = $attributeService;
        $this->categoryService = $categoryService;
    }
}
