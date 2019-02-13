<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Service;


use App\Http\Dao\SpecDao;
use App\Http\Dao\SpecOptionDao;
use App\Http\Model\Spec;
use App\Http\Model\SpuSpecOption;
use Illuminate\Support\Facades\Log;

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
     * @var SpecOptionDao
     */
    private $specOptionDao;

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
        $spec->category_id = $req["category_id"];
        $result = $this->specDao->insert($spec);
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
     * 获取规格列表
     *
     * @param $req
     * @return mixed
     */
    public function getSpecList(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->specDao->getByPage($pageNo, $size);
        foreach ($result as $spec) {
            $options = $this->specOptionDao->findBySpecId($spec->id);
            $spec->options = $options;
        }
        return $result;
    }

    /**
     * 分类获取
     *
     * @param int $categoryId
     * @return mixed
     */
    public function getSpecListByCategory(int $categoryId)
    {
        $result = $this->specDao->findByCategoryId($categoryId);
        foreach ($result as $spec) {
            $options = $this->specOptionDao->findBySpecId($spec->id);
            $spec->options = $options;
        }
        return $result;
    }

    /**
     * SpecService constructor.
     *
     * @param SpecDao $specDao
     * @param SpecOptionDao $specOptionDao
     */
    public function __construct(SpecDao $specDao, SpecOptionDao $specOptionDao)
    {
        $this->specDao = $specDao;
        $this->specOptionDao = $specOptionDao;
    }
}