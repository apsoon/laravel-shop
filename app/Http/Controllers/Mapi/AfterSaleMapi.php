<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\AfterSaleService;
use Illuminate\Http\Request;

/**
 * Class AfterSaleMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class AfterSaleMapi extends Controller
{
    /**
     * @var AfterSaleService
     */
    private $afterSaleService;

    /**
     * AfterSaleFapi constructor.
     *
     * @param AfterSaleService $afterSaleService
     */
    public function __construct(AfterSaleService $afterSaleService)
    {
        $this->afterSaleService = $afterSaleService;
    }
}
