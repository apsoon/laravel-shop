<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:31
 */

namespace App\Http\Dao;

use App\Http\Model\Brand;
use App\Http\Model\User;
use phpDocumentor\Reflection\Types\Integer;

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
//

    /**
     * 根据 id 查找
     *
     * @param Integer $id
     * @return mixed
     */
    public function getById(Integer $id)
    {
        $result = $this->brand::where(["id" => $id])
            ->first();
        return $result;
    }

    /**
     * 根据id删除
     *
     * @param Integer $id
     * @return mixed
     */
    public function deleteById(Integer $id)
    {
        $result = $this->brand::where("id", "=", $id)
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
    public function getAll()
    {
        $result = $this->brand::all();
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