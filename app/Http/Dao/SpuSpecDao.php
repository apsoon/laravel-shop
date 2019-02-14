<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/14
 * Time: 09:20
 */

namespace App\Http\Dao;


use App\Http\Model\SpuSpec;
use Illuminate\Support\Facades\DB;

class SpuSpecDao
{
    /**
     * @var SpuSpec
     */
    private $spuSpec;

    /**
     * 列表添加
     *
     * @param array $spuSpecList
     * @return bool
     */
    public function insertList(array $spuSpecList)
    {
        $result = DB::table($this->spuSpec->getTable())->insert($spuSpecList);
        return $result;
    }

    /**
     * 根据spuId获取
     *
     * @param $spuId
     * @return mixed
     */
    public function findBySpuId($spuId)
    {
        $result = $this->spuSpec::where("spu_id", "=", $spuId)
            ->get();
        return $result;
    }

    /**
     * SpuSpecDao constructor.
     * @param SpuSpec $spuSpec
     */
    public function __construct(SpuSpec $spuSpec)
    {
        $this->spuSpec = $spuSpec;
    }
}