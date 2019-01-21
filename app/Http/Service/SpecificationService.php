<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Service;


use App\Http\Dao\SpecificationDao;
use App\Http\Dao\SpecificationOptionDao;
use App\Http\Model\Specification;
use App\Http\Model\SpecificationOption;
use Illuminate\Support\Facades\Log;

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
     * @var SpecificationOptionDao
     */
    private $specificationOptionDao;

    /**
     * 创建
     *
     * @param array $req
     * @return bool
     */
    public function createSpecification(array $req)
    {
        $specification = new Specification();
        $specification->name = $req["name"];
        $specification->category_id = $req["category_id"];
        $result = $this->specificationDao->insert($specification);
        return $result;
    }

    /**
     * 创建规格选项
     *
     * @param array $req
     * @return bool
     */
    public function createSpecificationOption(array $req)
    {
        $specification_id = $req["specification_id"];
        $options = $req["options"];
        $arr = [];
        foreach ($options as $option) {
            array_push($arr, ["specification_id" => $specification_id, "name" => $option]);
        }
        $result = $this->specificationOptionDao->insertList($arr);
        return $result;
    }

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
        foreach ($result as $specification) {
            $options = $this->specificationOptionDao->findBySpecificationId($specification->id);
            $specification->options = $options;
        }
        return $result;
    }

    /**
     * SpecificationService constructor.
     *
     * @param SpecificationDao $specificationDao
     * @param SpecificationOptionDao $specificationOptionDao
     */
    public function __construct(SpecificationDao $specificationDao, SpecificationOptionDao $specificationOptionDao)
    {
        $this->specificationDao = $specificationDao;
        $this->specificationOptionDao = $specificationOptionDao;
    }
}