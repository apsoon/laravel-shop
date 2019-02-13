<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Dao;


use App\Http\Model\SpuDetail;

class SpuDetailDao
{
    /**
     * @var SpuDetail
     */
    private $spuDetail;

    /**
     * 添加详情
     *
     * @param SpuDetail $spuDetail
     * @return bool
     */
    public function insert(SpuDetail $spuDetail)
    {
        $result = $spuDetail->save();
        return $result;
    }

    /**
     * SpuId查找
     *
     * @param $spuId
     * @return mixed
     */
    public function findByGoodsId(int $spuId)
    {
        $result = $this->spuDetail::where(["spu_id" => $spuId])
            ->first();
        return $result;
    }

    /**
     * GoodsDetailDao constructor.
     *
     * @param SpuDetail $spuDetail
     */
    public function __construct(SpuDetail $spuDetail)
    {
        $this->spuDetail = $spuDetail;
    }
}