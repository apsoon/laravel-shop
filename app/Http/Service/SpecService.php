<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Service;


use App\Http\Dao\SkuSpecOptionDao;
use App\Http\Dao\SpecDao;
use App\Http\Dao\SpuSpecOptionDao;
use App\Http\Model\Spec;

/**
 * Class SpecService
 *
 * @package App\Http\Service
 */
class SpecService
{
    /**
     * @var SpecDao
     */
    private $specDao;

    /**
     * @var SpuSpecOptionDao
     */
    private $spuSpecOptionDao;

    /**
     * @var SkuSpecOptionDao
     */
    private $skuSpecOptionDao;

    /**
     * 创建
     *
     * @param array $req
     * @return bool
     */
    public function createSpec(array $req)
    {
        $spec = new Spec();
        $spec->name = $req["name"];
        $result = $this->specDao->insert($spec);
        return $result;
    }

    /**
     * 获取规格列表
     *
     * @return mixed
     */
    public function getSpecList()
    {
        $result = $this->specDao->list();
        return $result;
    }

    /**
     * 创建规格选项
     *
     * @param array $req
     * @return bool
     */
    public function createSpecOption(array $req)
    {
        $spec_id = $req["spec_id"];
        $options = $req["options"];
        $arr = [];
        foreach ($options as $option) {
            array_push($arr, ["spec_id" => $spec_id, "name" => $option]);
        }
        $result = $this->specOptionDao->insertList($arr);
        return $result;
    }

    /**
     * spuSpecOptionId 获取规格
     *
     * @param int $id
     * @return mixed
     */
    public function getSpecOptionById(int $id)
    {
        $result = $this->spuSpecOptionDao->findById($id);
        return $result;
    }

    /**
     * SpecService constructor.
     *
     * @param SpecDao $specDao
     * @param SkuSpecOptionDao $skuSpecOptionDao
     * @param SpuSpecOptionDao $spuSpecOptionDao
     */
    public function __construct(SpecDao $specDao, SkuSpecOptionDao $skuSpecOptionDao, SpuSpecOptionDao $spuSpecOptionDao)
    {
        $this->specDao = $specDao;
        $this->skuSpecOptionDao = $skuSpecOptionDao;
        $this->spuSpecOptionDao = $spuSpecOptionDao;
    }
}