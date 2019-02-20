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
     * CategoryFapi constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

}
