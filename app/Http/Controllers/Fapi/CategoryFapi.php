<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\CategoryService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

class CategoryFapi extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * treeList
     *
     * @return JsonResult
     */
    public function treeList()
    {
        return $this->categoryService->getCategoryTreeList();
    }

    /**
     * 首页热推
     *
     * @return JsonResult
     */
    public function recom()
    {
        return $this->categoryService->getRecomCategoryList();
    }

    /**
     * CategoryFapi constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware("auth-fapi");
        $this->categoryService = $categoryService;
    }

}
