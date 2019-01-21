<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Dao;


use App\Http\Model\SpecificationOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * 批量插入
     *
     * @param array $data
     * @return bool
     */
    public function insertList(Array $data)
    {
        Log::info($data);
        $result = DB::table($this->specificationOption->getTable())->insert($data);
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