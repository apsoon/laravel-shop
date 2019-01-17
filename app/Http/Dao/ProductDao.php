<?php

namespace App\Http\Dao;

use App\Http\Model\Product;

class ProductDao
{
    /**
     * @var Product
     */
    private $product;

    /**
     * @param int $goodsId
     * @return mixed
     */
    public function findByGoodsId(int $goodsId)
    {
        $result = $this->product::where(["goods_id" => $goodsId])
            ->get();
        return $result;
    }

    /**
     * ProductDao constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
}
