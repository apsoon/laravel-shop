<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/21
 * Time: 16:34
 */

namespace App\Http\Dao;


use App\Http\Model\SkuSpecOption;
use Illuminate\Support\Facades\DB;

/**
 * Class SkuSpecOptionDao
 *
 * @package App\Http\Dao
 */
class SkuSpecOptionDao
{

    /**
     * @var SkuSpecOption
     */
    private $skuSpecOption;

    /**
     * 插入列表
     *
     * @param array $options
     * @return bool
     */
    public function insertList(array $options)
    {
        $result = DB::table($this->skuSpecOption->getTable())->insert($options);
        return $result;
    }

    /**
     * 根据产品id查找
     *
     * @param int $skuId
     * @return mixed
     */
    public function findBySkuId(int $skuId)
    {
        $result = $this->skuSpecOption::where(["sku_id" => $skuId])
            ->get();
        return $result;
    }

    /**
     * SkuSpecOptionDao constructor.
     *
     * @param SkuSpecOption $skuSpecOption
     */
    public function __construct(SkuSpecOption $skuSpecOption)
    {
        $this->skuSpecOption = $skuSpecOption;
    }
}