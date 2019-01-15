<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Service\GoodsService;
use Illuminate\Http\Request;

class GoodsFapi extends Controller
{
    /**
     * @var GoodsService
     */
    private $goodsService;

    public function detail(Request $request)
    {

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
        $result = $this->goodsService->getGoodsByCategory($req);
        return $result;
    }

    /**
     * GoodsFapi constructor.
     * @param GoodsService $goodsService
     */
    public function __construct(GoodsService $goodsService)
    {
        $this->goodsService = $goodsService;
    }
}
