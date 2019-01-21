<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\BrandService;
use App\Http\Service\CategoryService;
use App\Http\Service\GoodsService;
use App\Http\Service\SpecificationService;
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

    private $specificationService;

    // ===========================================================================  goods ===========================================================================

    /**
     * 产品列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
     * 商品详情
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        $detail = $this->goodsService->getGoodsDetail($req);
        $productList = $this->goodsService->getProductByGoodsId($req["goods_id"]);
        return view('admin.pages.goods.goods_detail', ["detail" => $detail, "productList" => $productList]);
    }

    // ===========================================================================  product ===========================================================================

    /**
     * 添加产品
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProduct(Request $request)
    {
        $req = $request->all();
        $goods = $this->goodsService->getGoodsById($req["goods_id"]);
        $specificationList = $this->specificationService->getSpecificationListByCategory($goods->id);
        return view('admin.pages.goods.product_add', ["goods_id" => $req["goods_id"], "specificationList" => $specificationList]);
    }


    /**
     * 创建产品
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createProduct(Request $request)
    {
        $req = $request->all();
        Log::info($req);
//        $result = $this->goodsService->createProduct($req);
//        if ($result) return redirect("goods/detail?goods_id=" . $req["goods_id"]);
    }

    // ===========================================================================  construct ===========================================================================

    /**
     * GoodsMapi constructor.
     *
     * @param GoodsService $goodsService
     * @param CategoryService $categoryService
     * @param BrandService $brandService
     * @param SpecificationService $specificationService
     */
    public function __construct(GoodsService $goodsService, CategoryService $categoryService, BrandService $brandService, SpecificationService $specificationService)
    {
        $this->middleware('auth');
        $this->goodsService = $goodsService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->specificationService = $specificationService;
    }
}
