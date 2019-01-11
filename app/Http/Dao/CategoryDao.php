<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:31
 */

namespace App\Http\Dao;

use App\Http\Model\Category;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Class CategoryDao
 *
 * @package App\Http\Dao
 */
class CategoryDao
{

    /**
     * @var Category
     */
    private $category;

    /**
     * 添加商标
     *
     * @param  Category $category
     * @return bool
     */
    public function insert(Category $category)
    {
        return $category->save();
    }

    /**
     * 根据 id 查找
     *
     * @param Integer $id
     * @return mixed
     */
    public function getById(Integer $id)
    {
        $result = $this->category::where(["id" => $id])
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
        $result = $this->category::where("id", "=", $id)
            ->delete();
        return $result;
    }

    /**
     * @param Category $category
     *
     * @return mixed
     */
    public function update(Category $category)
    {
        $result = $category->save();
        return $result;
    }

    /**
     * 获取所有的分类
     *
     * @param $pageNo
     * @param $size
     * @return mixed
     */
    public function getAll(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->category::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }


    /**
     * 获取合并父类的分类
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUnitAll()
    {
        $result = $this->category::all();
        return $result;
    }

    /**
     * CategoryDao constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->$category = $category;
    }
}