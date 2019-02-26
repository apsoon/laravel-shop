<?php

namespace App\Http\Dao;

use App\Http\Model\Sku;

class SkuDao
{
    /**
     * @var Sku
     */
    private $sku;

    /**
     * 添加Sku
     *
     * @param Sku $sku
     * @return bool
     */
    public function insert(Sku $sku)
    {
        $result = $sku->save();
        return $result;
    }


    /**
     * 根据ID查找
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->sku::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * 根据ID查找上架的SKU
     *
     * @param int $id
     * @return mixed
     */
    public function findByIdEffect(int $id)
    {
        $result = $this->sku::where(["id" => $id, "state" => 1])
            ->first();
        return $result;
    }

    /**
     * @param int $spuId
     * @return mixed
     */
    public function findBySpuId(int $spuId)
    {
        $result = $this->sku::where(["spu_id" => $spuId])
            ->get();
        return $result;
    }

    /**
     * spu获取上架的sku
     *
     * @param int $spuId
     * @return mixed
     */
    public function findBySpuIdEffect(int $spuId)
    {
        $result = $this->sku::where(["spu_id" => $spuId, "state" => 1])
            ->get();
        return $result;
    }

    /**
     * 减少数量
     *
     * @param int $id
     * @param int $number
     * @return bool|int
     */
    public function decreaseNumber(int $id, int $number)
    {
        $result = $this->sku::where(["id" => $id])
            ->decrement("number", $number);
        return $result;
    }

    /**
     * 分类分页获取
     *
     * @param $categoryId
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByCategoryEffectPaged($categoryId, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->sku::where(["category_id" => $categoryId, "state" => 1])
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * SkuDao constructor.
     *
     * @param Sku $sku
     */
    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }
}
