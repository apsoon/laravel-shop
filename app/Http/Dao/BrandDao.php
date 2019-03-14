<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:31
 */

namespace App\Http\Dao;

use App\Http\Model\Brand;

/**
 * Class UserDao
 *
 * @package App\Http\Dao
 */
class BrandDao
{

    /**
     * @var Brand
     */
    private $brand;

    /**
     * 添加商标
     *
     * @param  Brand $brand
     * @return bool
     */
    public function insert(Brand $brand)
    {
        return $brand->save();
    }

    /**
     * 根据id查找
     *
     * @param Integer $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->brand::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * 根据id删除
     *
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id)
    {
        $result = $this->brand::where("id", "=", $id)
            ->delete();
        return $result;
    }

    /**
     * 批量删除
     *
     * @param array $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        $result = $this->brand::whereIn("id", $ids)
            ->delete();
        return $result;
    }

    /**
     * @param Brand $brand
     *
     * @return mixed
     */
    public function update(Brand $brand)
    {
        $result = $brand->save();
        return $result;
    }

    /**
     * 获取所有的商标
     *
     * @return Brand[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        $result = $this->brand::all();
        return $result;
    }

    /**
     * 分页获取
     *
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->brand::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 修改状态
     *
     * @param $id
     * @param $state
     * @return bool
     */
    public function updateStateById($id, $state)
    {
        $brand = $this->brand::where(["id" => $id])->first();
        if (!$brand) return false;
        $brand->state = $state;
        return $brand->save();
    }

    /**
     * id in
     *
     * @param array $brandIds
     * @return mixed
     */
    public function findByIdIn(array $brandIds)
    {
        $result = $this->brand::whereIn("id", $brandIds)->get();
        return $result;
    }

    /**
     * UserDao constructor.
     *
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
}