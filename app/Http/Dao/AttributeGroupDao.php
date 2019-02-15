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
 * Class AttributeDao
 *
 * @package App\Http\Dao
 */
class AttributeGroupDao
{
    /**
     * @var AttrGroup
     */
    private $attributeGroup;

    /**
     * @param AttrGroup $attributeGroup
     * @return bool
     */
    public function insert(AttrGroup $attributeGroup)
    {
        $result = $attributeGroup->save();
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
        $result = $this->attributeGroup::where(["id" => $id])
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
        $result = $this->attributeGroup::all();
        return $result;
    }

    public function findByCategoryId(int $categoryId)
    {
    }

    /**
     * AttributeGroupDao constructor.
     *
     * @param AttrGroup $attributeGroup
     */
    public function __construct(AttrGroup $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;
    }
}