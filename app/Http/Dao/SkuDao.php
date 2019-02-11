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
     * SkuDao constructor.
     *
     * @param Sku $sku
     */
    public function __construct(Sku $sku)
    {
        $this->sku = $sku;
    }
}
