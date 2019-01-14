<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Dao;


use App\Http\Model\Goods;

class GoodsDao
{
    /**
     * @var Goods
     */
    private $goods;

    /**
     * 添加商品
     *
     * @param Goods $goods
     * @return bool
     */
    public function insert(Goods $goods)
    {
        $result = $goods->save();
        return $result;
    }

    /**
     * 分页获取
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function getByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->goods::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * GoodsDao constructor.
     *
     * @param Goods $goods
     */
    public function __construct(Goods $goods)
    {
        $this->goods = $goods;
    }
}