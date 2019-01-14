<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 09:51
 */

namespace App\Http\Dao;


use App\Http\Model\Specification;

class SpecificationDao
{

    /**
     * @var Specification
     */
    private $specification;

    /**
     * 按页获取
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function getByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->specification::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * SpecificationDao constructor.
     *
     * @param Specification $specification
     */
    public function __construct(Specification $specification)
    {
        $this->specification = $specification;
    }
}