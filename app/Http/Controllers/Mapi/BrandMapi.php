<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\BrandService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandMapi extends Controller
{
    /**
     * @var BrandService
     */
    private $brandService;

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list()
    {
        $result = $this->brandService->getAllBrand();
        return view('admin.pages.goods.brand_list', ["brands" => $result]);
    }

    public function add()
    {
        return view('admin.pages.goods.brand_add');
    }

    /**
     * 创建品牌
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createBrand(Request $request)
    {
        $req = $request->all();
        $result = $this->brandService->createBrand($req);
        if ($result) return redirect("brand/list");
    }

    /**
     * BrandMapi constructor.
     *
     * @param BrandService $brandService
     */
    public function __construct(BrandService $brandService)
    {
        $this->middleware('auth');
        $this->brandService = $brandService;
    }
}
