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

    /**
     * @var BrandService
     */
    private $brandService;

    //
    public function list()
    {
        $req = [];
        $result = $this->goodsService->getGoodsList($req);
        return view('admin.pages.goods.goods_list', ["goodsList" => $result]);
    }

    /**
     * 添加商品页
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $categoryList = $this->categoryService->getUnitCategory();
        $brandList = $this->brandService->getAllBrand();
        return view('admin.pages.goods.goods_add', ["categoryList" => $categoryList, "brandList" => $brandList]);
    }

    /**
     * 商品详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        Log::info($req);
        $detail = $this->goodsService->getGoodsDetail($req);
        return view('admin.pages.goods.goods_detail', ["detail" => $detail]);
    }

    public function addProduct()
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createGoods(Request $request)
    {
        $req = $request->all();
        $result = $this->goodsService->createGoods($req);
        if ($result) return redirect("goods/list");
    }

    /**
     * GoodsMapi constructor.
     *
     * @param GoodsService $goodsService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     */
    public function __construct(GoodsService $goodsService, CategoryService $categoryService, BrandService $brandService)
    {
        $this->middleware('auth');
        $this->goodsService = $goodsService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
    }
}
