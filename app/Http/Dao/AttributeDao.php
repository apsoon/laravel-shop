<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 10:06
 */

namespace App\Http\Dao;


use App\Http\Model\Attribute;

/**
 * Class AttributeDao
 *
 * @package App\Http\Dao
 */
class AttributeDao
{
    /**
     * @var Attribute
     */
    private $attribute;

    /**
     * 分页获取
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function getByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->attribute::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * AttributeDao constructor.
     *
     * @param Attribute $attribute
     */
    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
}