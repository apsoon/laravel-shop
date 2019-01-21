<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/21
 * Time: 16:34
 */

namespace App\Http\Dao;


use App\Http\Model\ProductSpecificationOption;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductSpecificationOptionDao
 *
 * @package App\Http\Dao
 */
class ProductSpecificationOptionDao
{

    /**
     * @var ProductSpecificationOption
     */
    private $productSpecificationOption;

    /**
     * 插入列表
     *
     * @param array $options
     * @return bool
     */
    public function insertList(array $options)
    {
        $result = DB::table($this->productSpecificationOption->getTable())->insert($options);
        return $result;
    }

    /**
     * ProductSpecificationOptionDao constructor.
     *
     * @param ProductSpecificationOption $productSpecificationOption
     */
    public function __construct(ProductSpecificationOption $productSpecificationOption)
    {
        $this->productSpecificationOption = $productSpecificationOption;
    }
}