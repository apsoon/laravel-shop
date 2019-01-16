<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 10:07
 */

namespace App\Http\Service;


use App\Http\Dao\AttributeDao;
use App\Http\Dao\AttributeGroupDao;
use App\Http\Model\Attribute;
use App\Http\Model\AttributeGroup;

/**
 * Class AttributeService
 *
 * @package App\Http\Service
 */
class AttributeService
{
    /**
     * @var AttributeDao
     */
    private $attributeDao;

    /**
     * @var AttributeGroupDao
     */
    private $attributeGroupDao;

    /**
     * @param array $req
     * @return mixed
     */
    public function createAttribute(array $req)
    {
        $attribute = new Attribute();
        $attribute->name = $req["name"];
        $attribute->attribute_group = $req["attribute_group"];
        $result = $this->attributeDao->insert($attribute);
        return $result;
    }

    /**
     * 创建属性组
     *
     * @param array $req
     * @return bool
     */
    public function createAttributeGroup(array $req)
    {
        $attributeGroup = new AttributeGroup();
        $attributeGroup->name = $req["name"];
        $result = $this->attributeGroupDao->insert($attributeGroup);
        return $result;
    }

    /**
     * 获取属性列表
     *
     * @param $req
     * @return mixed
     */
    public function getAttributeList($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->attributeDao->getByPage($pageNo, $size);
        return $result;
    }

    /**
     * 获取属性组列表
     *
     * @return \App\Http\Model\AttributeGroup[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAttributeGroupList()
    {
        $result = $this->attributeGroupDao->findAll();
        return $result;
    }

    /**
     * AttributeService constructor.
     *
     * @param AttributeDao $attributeDao
     * @param AttributeGroupDao $attributeGroupDao
     */
    public function __construct(AttributeDao $attributeDao, AttributeGroupDao $attributeGroupDao)
    {
        $this->attributeDao = $attributeDao;
        $this->attributeGroupDao = $attributeGroupDao;
    }
}