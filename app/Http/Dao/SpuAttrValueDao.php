<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/22
 * Time: 15:32
 */

namespace App\Http\Dao;

use App\Http\Model\SpuAttrValue;
use Illuminate\Support\Facades\DB;

/**
 * Class AttrOptionDao
 *
 * @package App\Http\Dao
 */
class SpuAttrValueDao
{

    /**
     * @var SpuAttrValue
     */
    private $spuAttrValue;

    /**
     * 批量插入
     *
     * @param array $optionList
     * @return bool
     */
    public function insertList(array $optionList)
    {
        $result = DB::table($this->spuAttrValue->getTable())->insert($optionList);
        return $result;
    }

    /**
     * 属性id获取
     *
     * @param int $attrId
     * @return mixed
     */
    public function findByAttrId(int $attrId)
    {
        $result = $this->spuAttrValue::where(["attr_id" => $attrId])
            ->get();
        return $result;
    }

    /**
     * @param int $spuId
     * @return mixed
     */
    public function findBySpuId(int $spuId)
    {
        $result = $this->spuAttrValue::where("spu_id", "=", $spuId)
            ->get();
        return $result;
    }

    /**
     * AttrOptionDao constructor.
     *
     * @param SpuAttrValue $spuAttrValue
     */
    public function __construct(SpuAttrValue $spuAttrValue)
    {
        $this->spuAttrValue = $spuAttrValue;
    }
}