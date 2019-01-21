<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 10:06
 */

namespace App\Http\Dao;


use App\Http\Model\AttributeGroup;

/**
 * Class AttributeDao
 *
 * @package App\Http\Dao
 */
class AttributeGroupDao
{
    /**
     * @var AttributeGroup
     */
    private $attributeGroup;

    /**
     * @param AttributeGroup $attributeGroup
     * @return bool
     */
    public function insert(AttributeGroup $attributeGroup)
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
     * @return AttributeGroup[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        $result = $this->attributeGroup::all();
        return $result;
    }

    /**
     * AttributeGroupDao constructor.
     *
     * @param AttributeGroup $attributeGroup
     */
    public function __construct(AttributeGroup $attributeGroup)
    {
        $this->attributeGroup = $attributeGroup;
    }
}