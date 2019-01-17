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
     * 添加产品
     *
     * @param Product $product
     * @return bool
     */
    public function insert(Product $product)
    {
        $result = $product->save();
        return $result;
    }

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
