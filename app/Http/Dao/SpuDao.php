<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Dao;


use App\Http\Model\Spu;

class SpuDao
{
    /**
     * @var Spu
     */
    private $spu;

    /**
     * 添加Spu
     *
     * @param Spu $spu
     * @return bool
     */
    public function insert(Spu $spu)
    {
        $result = $spu->save();
        return $result;
    }

    /**
     * id查找
     *
     * @param $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->spu::where(["id" => $id])
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
        $result = $this->spu::where(["category_id" => $categoryId])
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
        $result = $this->spu::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 最近添加
     *
     * @param int $size
     * @return mixed
     */
    public function findByCreateDesc(int $size)
    {
        $result = $this->where(["state" => 1])
            ->limit($size)
            ->orderBy("create_at", "desc")
            ->get();
        return $result;
    }

    /**
     * SpuDao constructor.
     *
     * @param Spu $spu
     */
    public function __construct(Spu $spu)
    {
        $this->spu = $spu;
    }
}