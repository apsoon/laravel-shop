<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Service\BrandService;
use Illuminate\Http\Request;

/**
 * Class BrandFapi
 *
 * @package App\Http\Controllers
 */
class BrandFapi extends Controller
{
    /**
     * @var BrandService
     */
    private $brandService;

    /**
     * @param Request $request
     * @return \App\Http\Util\JsonResult
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        return $this->brandService->getBrandById($req);
    }

    /**
     * BrandFapi constructor.
     *
     * @param BrandService $brandService
     */
    public function __construct(BrandService $brandService)
    {
        $this->middleware("auth-fapi");
        $this->brandService = $brandService;
    }
}
