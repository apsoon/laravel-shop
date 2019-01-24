<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductFapi extends Controller
{
    private $productService;
    //
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
}
