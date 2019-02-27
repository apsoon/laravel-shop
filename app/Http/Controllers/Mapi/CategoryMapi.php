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
     * 获取树形分类
     *
     * @return JsonResult
     */
    public function treeList()
    {
        return $this->categoryService->getCategoryTreeList();
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
        return $this->categoryService->createCategory($req);
    }

    /**
     * 设置分类热推
     *
     * @param Request $request
     * @return JsonResult
     */
    public function modifyRecom(Request $request)
    {
        $req = $request->all();
        return $this->categoryService->modifyCategoryRecom($req);
    }

    /**
     * 删除分类
     *
     * @param Request $request
     * @return JsonResult
     */
    public function delete(Request $request)
    {
        $req = $request->all();
        return $this->categoryService->deleteCategoryById($req);
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
