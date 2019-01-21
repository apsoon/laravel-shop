<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Dao;


use App\Http\Model\GoodsDetail;

class GoodsDetailDao
{
    /**
     * @var GoodsDetail
     */
    private $goodsDetail;

    /**
     * 添加详情
     *
     * @param GoodsDetail $goodsDetail
     * @return bool
     */
    public function insert(GoodsDetail $goodsDetail)
    {
        $result = $goodsDetail->save();
        return $result;
    }

    /**
     * 商品id查找
     *
     * @param $id
     * @return mixed
     */
    public function findByGoodsId($id)
    {
        $result = $this->goods::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * GoodsDetailDao constructor.
     *
     * @param GoodsDetail $goodsDetail
     */
    public function __construct(GoodsDetail $goodsDetail)
    {
        $this->goodsDetail = $goodsDetail;
    }
}