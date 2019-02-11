<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 15:01
 */

namespace App\Http\Controllers\Fapi;


use App\Http\Dao\SkuDao;

class ProductService
{
    private $productDao;

    public function __construct(SkuDao $productDao)
    {
        $this->productDao = $productDao;
    }
}