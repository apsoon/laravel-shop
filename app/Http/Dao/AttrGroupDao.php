<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 10:06
 */

namespace App\Http\Dao;


use App\Http\Model\AttrGroup;

/**
 * Class AttrDao
 *
 * @package App\Http\Dao
 */
class AttrGroupDao
{
    /**
     * @var AttrGroup
     */
    private $attrGroup;

    /**
     * @param AttrGroup $attrGroup
     * @return bool
     */
    public function insert(AttrGroup $attrGroup)
    {
        $result = $attrGroup->save();
        return $result;
    }

    /**
     * id 查找
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->attrGroup::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * 获取所有属性组
     *
     * @return AttrGroup[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        $result = $this->attrGroup::all();
        return $result;
    }

    public function findByCategoryId(int $categoryId)
    {
    }

    /**
     * AttrGroupDao constructor.
     *
     * @param AttrGroup $attrGroup
     */
    public function __construct(AttrGroup $attrGroup)
    {
        $this->attrGroup = $attrGroup;
    }
}