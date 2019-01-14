<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\BrandService;
use Illuminate\Http\Request;

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
