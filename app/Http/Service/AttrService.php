<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 10:07
 */

namespace App\Http\Service;


use App\Http\Dao\AttrDao;
use App\Http\Dao\AttrGroupDao;
use App\Http\Dao\AttrOptionDao;
use App\Http\Dao\CategoryDao;
use App\Http\Model\Attr;
use App\Http\Model\AttrGroup;

/**
 * Class AttrService
 *
 * @package App\Http\Service
 */
class AttrService
{
    /**
     * @var AttrDao
     */
    private $attrDao;

    /**
     * @var AttrGroupDao
     */
    private $attrGroupDao;

    /**
     * @var AttrOptionDao
     */
    private $attrOptionDao;

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
    public function createAttr(array $req)
    {
        $attr = new Attr();
        $attr->name = $req["name"];
        $attr->attr_group_id = $req["attr_group_id"];
        $result = $this->attrDao->insert($attr);
        return $result;
    }

    // ===========================================================================  attr ===========================================================================

    /**
     * 获取属性列表
     *
     * @param $req
     * @return mixed
     */
    public function getAttrList($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->attrDao->getByPage($pageNo, $size);
        foreach ($result as $attr) {
            $group = $this->attrGroupDao->findById($attr->attr_group_id);
            $attr->group_name = $group->name;
            $category = $this->categoryDao->findById($group->category_id);
//            $attr->category_id = $category->id;
            $attr->category_name = $category->name;
            $options = $this->attrOptionDao->findByAttrId($attr->id);
            $attr->options = $options;
        }
        return $result;
    }

    /**
     *
     * @param int $categoryId
     * @return mixed
     */
    public function getAttrGroupOptionByCategory(int $categoryId)
    {
        $result = $this->attrGroupDao->findByCategoryId($categoryId);
        foreach ($result as $group) {
            $attrs = $this->attrDao->findByGroupId($group->id);
            foreach ($attrs as $attr) {
                $options = $this->attrOptionDao->findByAttrId($attr->id);
                $attr->options = $options;
            }
            $group->attrs = $attrs;
        }
        return $result;
    }

    // ===========================================================================  attr group  ===========================================================================

    /**
     * 创建属性组
     *
     * @param array $req
     * @return bool
     */
    public function createAttrGroup(array $req)
    {
        $attrGroup = new AttrGroup();
        $attrGroup->name = $req["name"];
        $attrGroup->category_id = $req["categoryId"];
        $result = $this->attrGroupDao->insert($attrGroup);
        return $result;
    }

    /**
     * 获取属性组列表
     *
     * @return \App\Http\Model\AttrGroup[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAttrGroupList()
    {
        $result = $this->attrGroupDao->findAll();
        return $result;
    }

    // ===========================================================================  attr option  ===========================================================================

    /**
     * 创建属性选项
     *
     * @param array $req
     * @return bool
     */
    public function createAttrOption(array $req)
    {
        $attrId = $req["attrId"];
        $groupId = $this->attrDao->findById($attrId)->attr_group_id;
        $options = $req["options"];
        $arr = [];
        foreach ($options as $option) {
            array_push($arr, ["attr_id" => $attrId, "attr_group_id" => $groupId, "name" => $option]);
        }
        $result = $this->attrOptionDao->insertList($arr);
        return $result;
    }

    /**
     * 属性id获取选项
     *
     * @param int $attrId
     * @return mixed
     */
    public function getOptionByAttrId(int $attrId)
    {
        $result = $this->attrOptionDao->findByAttrId($attrId);
        return $result;
    }

    // ===========================================================================  constructor  ===========================================================================

    /**
     * AttrService constructor.
     *
     * @param AttrDao $attrDao
     * @param AttrGroupDao $attrGroupDao
     * @param AttrOptionDao $attrOptionDao
     * @param CategoryDao $categoryDao
     */
    public function __construct(AttrDao $attrDao, AttrGroupDao $attrGroupDao, AttrOptionDao $attrOptionDao, CategoryDao $categoryDao)
    {
        $this->attrDao = $attrDao;
        $this->attrGroupDao = $attrGroupDao;
        $this->attrOptionDao = $attrOptionDao;
        $this->categoryDao = $categoryDao;
    }
}