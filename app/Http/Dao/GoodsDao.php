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
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $result = $this->goods::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * 分页按照分类获取
     *
     * @param int $categoryId
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByCategoryPaged(int $categoryId, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->goods::where(["category_id" => $categoryId])
            ->offset($offset)
            ->limit($size)
            ->get();
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