<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Dao;


use App\Http\Model\SpecificationOption;

class SpecificationOptionDao
{

    /**
     * @var SpecificationOption
     */
    private $specificationOption;

    /**
     * 添加
     *
     * @param SpecificationOption $specificationOption
     * @return mixed
     */
    public function insert(SpecificationOption $specificationOption)
    {
        $result = $specificationOption->save();
        return $result;
    }

    /**
     * 根据规格id查找
     *
     * @param int $specificationId
     * @return mixed
     */
    public function findBySpecificationId(int $specificationId)
    {
        $result = $this->specificationOption::where(["specification_id" => $specificationId])
            ->get();
        return $result;
    }

    /**
     * SpecificationOptionDao constructor.
     *
     * @param SpecificationOption $specificationOption
     */
    public function __construct(SpecificationOption $specificationOption)
    {
        $this->specificationOption = $specificationOption;
    }
}