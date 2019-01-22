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
use App\Http\Dao\AttributeOptionDao;
use App\Http\Dao\CategoryDao;
use App\Http\Model\Attribute;
use App\Http\Model\AttributeGroup;
use App\Http\Model\AttributeOption;
use Illuminate\Support\Facades\Log;

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
     * @var AttributeOptionDao
     */
    private $attributeOptionDao;

    /**
     * @var CategoryDao
     */
    private $categoryDao;

    /**
     * 创建属性
     *
     * @param array $req
     * @return mixed
     */
    public function createAttribute(array $req)
    {
        $attribute = new Attribute();
        $attribute->name = $req["name"];
        $attribute->attribute_group_id = $req["attribute_group_id"];
        $result = $this->attributeDao->insert($attribute);
        return $result;
    }

    // ===========================================================================  attribute ===========================================================================

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
        foreach ($result as $attribute) {
            $group = $this->attributeGroupDao->findById($attribute->attribute_group_id);
            $attribute->group_name = $group->name;
            $category = $this->categoryDao->findById($group->category_id);
//            $attribute->category_id = $category->id;
            $attribute->category_name = $category->name;
            $options = $this->attributeOptionDao->findByAttributeId($attribute->id);
            $attribute->options = $options;
        }
        return $result;
    }

    // ===========================================================================  attribute group  ===========================================================================

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
        $attributeGroup->category_id = $req["category_id"];
        $result = $this->attributeGroupDao->insert($attributeGroup);
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

    // ===========================================================================  attribute option  ===========================================================================

    /**
     * 创建属性选项
     *
     * @param array $req
     * @return bool
     */
    public function createAttributeOption(array $req)
    {
        $attributeId = $req["attributeId"];
        $groupId = $this->attributeDao->findById($attributeId)->attribute_group_id;
        $options = $req["options"];
        $arr = [];
        foreach ($options as $option) {
            array_push($arr, ["attribute_id" => $attributeId, "attribute_group_id" => $groupId, "name" => $option]);
        }
        $result = $this->attributeOptionDao->insertList($arr);
        return $result;
    }

    /**
     * 属性id获取选项
     *
     * @param int $attributeId
     * @return mixed
     */
    public function getOptionByAttributeId(int $attributeId)
    {
        $result = $this->attributeOptionDao->findByAttributeId($attributeId);
        return $result;
    }

    // ===========================================================================  constructor  ===========================================================================

    /**
     * AttributeService constructor.
     *
     * @param AttributeDao $attributeDao
     * @param AttributeGroupDao $attributeGroupDao
     * @param AttributeOptionDao $attributeOptionDao
     * @param CategoryDao $categoryDao
     */
    public function __construct(AttributeDao $attributeDao, AttributeGroupDao $attributeGroupDao, AttributeOptionDao $attributeOptionDao, CategoryDao $categoryDao)
    {
        $this->attributeDao = $attributeDao;
        $this->attributeGroupDao = $attributeGroupDao;
        $this->attributeOptionDao = $attributeOptionDao;
        $this->categoryDao = $categoryDao;
    }
}