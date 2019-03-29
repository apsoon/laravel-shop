<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/13
 * Time: 16:35
 */

namespace App\Http\Dao;


use App\Http\Model\CategoryBrand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CategoryBrandDao
 * @package App\Http\Dao
 */
class CategoryBrandDao
{

    /**
     * @var CategoryBrand
     */
    private $categoryBrand;

    /**
     * 品牌获取
     *
     * @param $categoryId
     * @return mixed
     */
    public function findByCategory($categoryId)
    {
        return $this->categoryBrand::where("category_id", "=", $categoryId)->get();
    }

    /**
     * 批量添加
     *
     * @param array $insertList
     * @return bool
     */
    public function insertList(array $insertList)
    {
        return DB::table($this->categoryBrand->getTable())->insert($insertList);
    }

    /**
     * 分类删除
     *
     * @param $categoryId
     * @return mixed
     */
    public function deleteByCategory($categoryId)
    {
        return $this->categoryBrand::where("category_id", "=", $categoryId)->delete();
    }

    /**
     * CategoryBrandDao constructor.
     * @param CategoryBrand $categoryBrand
     */
    public function __construct(CategoryBrand $categoryBrand)
    {
        $this->categoryBrand = $categoryBrand;
    }
}