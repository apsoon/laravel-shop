<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\BrandService;
use App\Http\Service\CategoryService;
use App\Http\Service\GoodsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoodsMapi extends Controller
{
    /**
     * @var GoodsService
     */
    private $goodsService;

    /**
     * @var CategoryService
     */
    private $categoryService;

    //
    public function list()
    {
        $req = [];
        $result = $this->goodsService->getGoodsList($req);
        return view('admin.pages.goods.goods_list',["goodsList"=>$result]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $categories = $this->categoryService->getUnitCategory();
        return view('admin.pages.goods.goods_add', ["categories" => $categories]);
    }

    public function createGoods()
    {

    }

    /**
     * GoodsMapi constructor.
     *
     * @param GoodsService $goodsService
     * @param CategoryService $categoryService
     */
    public function __construct(GoodsService $goodsService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->goodsService = $goodsService;
        $this->categoryService = $categoryService;
    }
}
