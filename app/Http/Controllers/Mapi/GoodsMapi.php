<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\GoodsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoodsMapi extends Controller
{
    private $goodsService;

    //
    public function list()
    {
        return view('admin.pages.goods.goods_list');
    }

    public function add()
    {
        return view('admin.pages.goods.goods_add');
    }

    public function createGoods()
    {

    }

    /**
     * GoodsMapi constructor.
     * @param GoodsService $goodsService
     */
    public function __construct(GoodsService $goodsService)
    {
        $this->middleware('auth');
        $this->goodsService = $goodsService;
    }
}
