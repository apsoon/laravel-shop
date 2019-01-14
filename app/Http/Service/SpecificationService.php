<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Service;


use App\Http\Dao\SpecificationDao;

/**
 * Class SpecificationService
 *
 * @package App\Http\Service
 */
class SpecificationService
{
    /**
     * @var SpecificationDao
     */
    private $specificationDao;

    /**
     * 获取规格列表
     *
     * @param $req
     * @return mixed
     */
    public function getSpecificationList($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->specificationDao->getByPage($pageNo, $size);
        return $result;
    }

    /**
     * SpecificationService constructor.
     *
     * @param SpecificationDao $specificationDao
     */
    public function __construct(SpecificationDao $specificationDao)
    {
        $this->specificationDao = $specificationDao;
    }
}