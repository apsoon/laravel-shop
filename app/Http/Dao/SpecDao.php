<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Dao;


use App\Http\Model\Spec;

class SpecDao
{

    /**
     * @var Spec
     */
    private $spec;

    /**
     * 添加
     *
     * @param Spec $spec
     * @return bool
     */
    public function insert(Spec $spec)
    {
        $result = $spec->save();
        return $result;
    }

    /**
     * 获取所有规格
     *
     * @return Spec[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        $result = $this->spec->all();
        return $result;
    }

    /**
     * 按页获取
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function getByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->spec::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 分类获取
     *
     * @param int $categoryId
     * @return mixed
     */
    public function findByCategoryId(int $categoryId)
    {
        $result = $this->spec::where(["category_id" => $categoryId])
            ->get();
        return $result;
    }

    /**
     * id查找
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->spec::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * SpecDao constructor.
     *
     * @param Spec $spec
     */
    public function __construct(Spec $spec)
    {
        $this->spec = $spec;
    }
}