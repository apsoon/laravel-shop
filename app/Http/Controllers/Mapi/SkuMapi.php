<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\SkuService;
use App\Http\Service\SpuService;
use Illuminate\Http\Request;

class SkuMapi extends Controller
{
    /**
     * @var SpuService
     */
    private $spuService;

    /**
     * @var SkuService
     */
    private $skuService;

    public function list(Request $request)
    {
    }

    public function create(Request $request)
    {
    }

    public function detail(Request $request)
    {
    }


    public function __construct(SpuService $spuService, SkuService $skuService)
    {
        $this->spuService = $spuService;
        $this->skuService = $skuService;
    }
}
