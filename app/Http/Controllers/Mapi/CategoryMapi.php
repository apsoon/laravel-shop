<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\CategoryService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class CategoryMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class CategoryMapi extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * 获取分类列表
     *
     * @return JsonResult
     */
    public function list()
    {
        $result = $this->categoryService->getCategoryList();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取树形分类
     *
     * @return JsonResult
     */
    public function treeList()
    {
        $result = $this->categoryService->getCategoryTreeList();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 添加分类
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->categoryService->createCategory($req);
        if ($result) return new JsonResult();
    }

    /**
     * CategoryMapi constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
}
