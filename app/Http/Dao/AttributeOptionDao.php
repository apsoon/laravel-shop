<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/22
 * Time: 15:32
 */

namespace App\Http\Dao;

use App\Http\Model\AttrOption;
use Illuminate\Support\Facades\DB;

/**
 * Class AttributeOptionDao
 *
 * @package App\Http\Dao
 */
class AttributeOptionDao
{

    /**
     * @var AttrOption
     */
    private $attributeOption;

    /**
     * 批量插入
     *
     * @param array $optionList
     * @return bool
     */
    public function insertList(array $optionList)
    {
        $result = DB::table($this->attributeOption->getTable())->insert($optionList);
        return $result;
    }

    /**
     * 属性id获取
     *
     * @param int $attributeId
     * @return mixed
     */
    public function findByAttributeId(int $attributeId)
    {
        $result = $this->attributeOption::where(["attribute_id" => $attributeId])
            ->get();
        return $result;
    }

    /**
     * AttributeOptionDao constructor.
     *
     * @param AttrOption $attributeOption
     */
    public function __construct(AttrOption $attributeOption)
    {
        $this->attributeOption = $attributeOption;
    }
}