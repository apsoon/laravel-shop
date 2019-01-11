<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryFapi extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * unitList
     *
     * @return \App\Http\Model\Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function unitList()
    {
        $result = $this->categoryService->getUnitCategory();
        return $result;
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
