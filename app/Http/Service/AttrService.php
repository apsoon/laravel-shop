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
use App\Http\Dao\SpuAttrValueDao;
use App\Http\Dao\CategoryDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Attr;
use App\Http\Model\AttrGroup;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\Log;

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
     * @var SpuAttrValueDao
     */
    private $spuAttrValueDao;

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
        $attr->attr_group_id = $req["attrGroupId"];
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
            $options = $this->spuAttrValueDao->findByAttrId($attr->id);
            $attr->options = $options;
        }
        return $result;
    }

    /**
     * 分组获取属性
     *
     * @param array $req
     * @return mixed
     */
    public function getAttrListByGroup(array $req)
    {
        $result = $this->attrDao->findByGroupId($req["attrGroupId"]);
        return $result;
    }

    /**
     * SPU 获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getAttrListWithValueBySpu(array $req)
    {
        $result = $this->spuAttrValueDao->findBySpuId($req["spuId"]);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     *
     * @param array $req
     * @return mixed
     */
    public function getAttrGroupOptionByCategory(array $req)
    {
        $result = $this->attrGroupDao->findByCategoryId($req["categoryId"]);
        foreach ($result as $group) {
            $attrs = $this->attrDao->findByGroupId($group->id);
            foreach ($attrs as $attr) {
                $options = $this->spuAttrValueDao->findByAttrId($attr->id);
                $attr->options = $options;
            }
            $group->attrs = $attrs;
        }
        return new JsonResult(StatusCode::SUCCESS, $result);
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
        $result = $this->attrGroupDao->list();
        return $result;
    }

    /**
     * 分页获取分类
     *
     * @param array $req
     * @return mixed
     */
    public function getPagedAttrGroupWithAttrList(array $req)
    {
        $size = 20;
        $groups = $this->attrGroupDao->findByPage($req["pageNo"], $size);
        foreach ($groups as $group) {
            $attr = $this->attrDao->findByGroupId($group->id);
            $group->attrs = $attr;
        }
        return $groups;
    }

    // ===========================================================================  attr option  ===========================================================================

    /**
     * 创建SPU属性值
     *
     * @param array $req
     * @return JsonResult
     */
    public function createSpuAttrValue(array $req)
    {
        $spuAttrList = $req["spuAttrList"];
        $spuId = $req["spuId"];
        $arr = [];
        foreach ($spuAttrList as $spuAttr) {
            Log::info($spuAttr);
            array_push($arr, ["spu_id" => $spuId, "attr_id" => $spuAttr["attrId"], "attr_group_id" => $spuAttr["attrGroupId"], "value" => $spuAttr["value"]]);
        }
        $result = $this->spuAttrValueDao->insertList($arr);
        if ($result) return new JsonResult(StatusCode::SUCCESS, $result);
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 属性id获取选项
     *
     * @param int $attrId
     * @return mixed
     */
    public function getOptionByAttrId(int $attrId)
    {
        $result = $this->spuAttrValueDao->findByAttrId($attrId);
        return $result;
    }

//    /**
//     * spu 获取
//     * @param array $req
//     * @return JsonResult
//     */
//    public function getOptionBySpu(array $req)
//    {
//        $result = $this->spuAttrValueDao->findBySpuId($req["spuId"]);
//        return new JsonResult(StatusCode::SUCCESS, $result);
//    }

    // ===========================================================================  constructor  ===========================================================================

    /**
     * AttrService constructor.
     *
     * @param AttrDao $attrDao
     * @param AttrGroupDao $attrGroupDao
     * @param SpuAttrValueDao $spuAttrValueDao
     * @param CategoryDao $categoryDao
     */
    public function __construct(AttrDao $attrDao, AttrGroupDao $attrGroupDao, SpuAttrValueDao $spuAttrValueDao, CategoryDao $categoryDao)
    {
        $this->attrDao = $attrDao;
        $this->attrGroupDao = $attrGroupDao;
        $this->spuAttrValueDao = $spuAttrValueDao;
        $this->categoryDao = $categoryDao;
    }
}