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
use App\Http\Dao\SpuSpecDao;
use App\Http\Dao\SpuSpecOptionDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Spec;
use App\Http\Util\JsonResult;

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
     * @var SpuSpecDao
     */
    private $spuSpecDao;

    /**
     * 创建
     *
     * @param array $req
     * @return JsonResult
     */
    public function createSpec(array $req)
    {
        $spec = new Spec();
        $spec->name = $req["name"];
        $result = $this->specDao->insert($spec);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取规格列表
     *
     * @return mixed
     */
    public function getSpecList()
    {
        $result = $this->specDao->list();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取SPU规格列表
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSpecListBySpu(array $req)
    {
        $spuSpecList = $this->spuSpecDao->findBySpuId($req["spuId"]);
        $specIds = [];
        foreach ($spuSpecList as $spuSpec) {
            array_push($specIds, $spuSpec->spec_id);
        }
        $result = $this->specDao->findByIds($specIds);
        return new JsonResult(StatusCode::SUCCESS, $result);
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
     * @param array $req
     * @return mixed
     */
    public function deleteSpecBySpu(array $req)
    {
        $ids = $req["ids"];
        if (sizeof($ids) == 1) {
            $result = $this->spuSpecDao->deleteBySpuId($ids[0]);
        } else {
            $result = $this->spuSpecDao->deleteBySpuIds($ids);
        }
        return $result;
    }

    /**
     * SpecService constructor.
     *
     * @param SpecDao $specDao
     * @param SpuSpecDao $spuSpecDao
     * @param SkuSpecOptionDao $skuSpecOptionDao
     * @param SpuSpecOptionDao $spuSpecOptionDao
     */
    public function __construct(SpecDao $specDao, SpuSpecDao $spuSpecDao, SkuSpecOptionDao $skuSpecOptionDao, SpuSpecOptionDao $spuSpecOptionDao)
    {
        $this->specDao = $specDao;
        $this->spuSpecDao = $spuSpecDao;
        $this->skuSpecOptionDao = $skuSpecOptionDao;
        $this->spuSpecOptionDao = $spuSpecOptionDao;
    }
}