<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 10:06
 */

namespace App\Http\Dao;


use App\Http\Model\Attr;

/**
 * Class AttrDao
 *
 * @package App\Http\Dao
 */
class AttrDao
{
    /**
     * @var Attr
     */
    private $attr;

    /**
     * @param Attr $attr
     * @return bool
     */
    public function insert(Attr $attr)
    {
        $result = $attr->save();
        return $result;
    }

    public function findById(int $id)
    {
        $result = $this->attr::where(["id" => $id])
            ->first();
        return $result;
    }

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
        $result = $this->attr::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }


    public function findByGroupId($id)
    {
    }

    /**
     * AttrDao constructor.
     *
     * @param Attr $attr
     */
    public function __construct(Attr $attr)
    {
        $this->attr = $attr;
    }
}