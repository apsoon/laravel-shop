<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 10:07
 */

namespace App\Http\Service;


use App\Http\Dao\AttributeDao;

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
     * AttributeService constructor.
     *
     * @param AttributeDao $attributeDao
     */
    public function __construct(AttributeDao $attributeDao)
    {
        $this->attributeDao = $attributeDao;
    }
}