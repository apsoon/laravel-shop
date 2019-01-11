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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->categoryService->getAllCategory($req);
        return view('admin.pages.goods.category_list', ["categories" => $result]);
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
