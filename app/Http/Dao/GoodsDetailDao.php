<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Dao;


use App\Http\Model\GoodsDetail;
use Illuminate\Support\Facades\Log;

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
     * @param $goodsId
     * @return mixed
     */
    public function findByGoodsId(int $goodsId)
    {
        Log::info("88888888888888888888888 --- ".$goodsId);

        $result = $this->goodsDetail::where(["goods_id" => $goodsId])
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