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
 * Class AttrOptionDao
 *
 * @package App\Http\Dao
 */
class AttrOptionDao
{

    /**
     * @var AttrOption
     */
    private $attrOption;

    /**
     * 批量插入
     *
     * @param array $optionList
     * @return bool
     */
    public function insertList(array $optionList)
    {
        $result = DB::table($this->attrOption->getTable())->insert($optionList);
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
        $result = $this->attrOption::where(["attr_id" => $attrId])
            ->get();
        return $result;
    }

    /**
     * AttrOptionDao constructor.
     *
     * @param AttrOption $attrOption
     */
    public function __construct(AttrOption $attrOption)
    {
        $this->attrOption = $attrOption;
    }
}