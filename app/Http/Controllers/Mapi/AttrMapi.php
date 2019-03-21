<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\AttrService;
use App\Http\Service\CategoryService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * Class AttrMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class AttrMapi extends Controller
{
    /**
     * @var AttrService
     */
    private $attrService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    // ===========================================================================  attr ===========================================================================

    /**
     * 获取属性列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->attrService->getAttrList($req);
        return view('admin.pages.goods.attr_list', ["attrs" => $result]);
    }

    /**
     * 根据分组获取属性
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listByGroup(Request $request)
    {
        $req = $request->all();
        $result = $this->attrService->getAttrListByGroup($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 根据spu获取
     *
     * @param Request $request
     * @return JsonResult
     */
    public function valueListBySpu(Request $request)
    {
        $req = $request->all();
        return $this->attrService->getSpuAttrValueList($req);
    }

    /**
     * 添加属性
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function add()
    {
        $groupList = $this->attrService->getAttrGroupList();
        return view("admin.pages.goods.attr_add", ["groupList" => $groupList]);
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
        $result = $this->attrService->createAttr($req);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    // ===========================================================================  attr group  ===========================================================================

    /**
     * 创建属性组
     *
     * @param Request $request
     * @return JsonResult
     */
    public function createGroup(Request $request)
    {
        $req = $request->all();
        $result = $this->attrService->createAttrGroup($req);
        if ($result) return new JsonResult();
        else return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 分页获取属性组
     *
     * @param Request $request
     * @return JsonResult
     */
    public function groupList(Request $request)
    {
        $req = $request->all();
        $result = $this->attrService->getPagedAttrGroupWithAttrList($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
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
        return $this->attrService->getAttrGroupOptionByCategory($req);
    }

    // ===========================================================================  attr value ===========================================================================

    /**
     * 创建spu attr value
     *
     * @param Request $request
     * @return JsonResult
     */
    public function createValue(Request $request)
    {
        $req = $request->all();
        return $this->attrService->createSpuAttrValue($req);
    }

    /**
     * AttrMapi constructor.
     *
     * @param AttrService $attrService
     * @param CategoryService $categoryService
     */
    public function __construct(AttrService $attrService, CategoryService $categoryService)
    {
        $this->middleware("auth-mapi");
        $this->attrService = $attrService;
        $this->categoryService = $categoryService;
    }
}
