<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/14
 * Time: 09:20
 */

namespace App\Http\Dao;


use App\Http\Model\SpuSpecOption;
use Illuminate\Support\Facades\DB;

class SpuSpecOptionDao
{
    /**
     * @var SpuSpecOption
     */
    private $spuSpecOption;

    /**
     * 列表添加
     *
     * @param array $spuSpecOptionList
     * @return bool
     */
    public function insertList(array $spuSpecOptionList)
    {
        $result = DB::table($this->spuSpecOption->getTable())->insert($spuSpecOptionList);
        return $result;
    }

    /**
     * spuId查找
     *
     * @param $spuId
     * @return mixed
     */
    public function findBySpuId($spuId)
    {
        $result = $this->spuSpecOption::where("spu_id", "=", $spuId)
            ->get();
        return $result;
    }

    /**
     * 根据spuId获取
     *
     * @param $spuId
     * @return mixed
     */
    public function findBySpuIdSpecId($spuId, $specId)
    {
        $result = $this->spuSpecOption::where(["spu_id" => $spuId, "spec_id" => $specId])
            ->get();
        return $result;
    }

    /**
     * SpuSpecOptionDao constructor.
     * @param SpuSpecOption $spuSpecOption
     */
    public function __construct(SpuSpecOption $spuSpecOption)
    {
        $this->spuSpecOption = $spuSpecOption;
    }
}