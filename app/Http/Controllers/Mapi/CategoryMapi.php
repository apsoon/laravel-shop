<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryMapi extends Controller
{
    /**
     * @var CategoryService
     */
    private $categoryService;

    /**
     * list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $result = $this->categoryService->getUnitCategory();
        return view('admin.pages.goods.category_list', ["categories" => $result]);
    }

    /**
     * CategoryMapi constructor.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->categoryService = $categoryService;
    }
}
