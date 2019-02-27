<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:31
 */

namespace App\Http\Dao;

use App\Http\Model\Category;

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
     * list
     *
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        $result = $this->category::all();
        return $result;
    }

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
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        $result = $this->category::where(["id" => $id])
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
     * 分页获取所有的分类
     *
     * @param $pageNo
     * @param $size
     * @return mixed
     */
    public function findByPage(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->category::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * 设置热推
     *
     * @param $id
     * @param $isRecom
     * @return mixed
     */
    public function modifyRecomById($id, $isRecom)
    {
        $result = $this->category::where("id", "=", $id)
            ->update(["is_recom" => $isRecom]);
        return $result;
    }

    /**
     * 获取热推
     *
     * @return mixed
     */
    public function findRecomList()
    {
        return $this->category::where("is_recom", "=", 1)->get();
    }

    /**
     * CategoryDao constructor.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}