<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Service\SpuService;
use Illuminate\Http\Request;

class GoodsFapi extends Controller
{
    /**
     * @var SpuService
     */
    private $SpuService;

    /**
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        $result = $this->SpuService->getSpuDetail($req);
        return $result;
    }

    /**
     * 分类获取
     *
     * @param Request $request
     * @return mixed
     */
    public function getByCategory(Request $request)
    {
        $req = $request->all();
        $result = $this->SpuService->getSpuByCategory($req);
        return $result;
    }

    /**
     * SpuFapi constructor.
     * @param SpuService $SpuService
     */
    public function __construct(SpuService $SpuService)
    {
        $this->SpuService = $SpuService;
    }
}
