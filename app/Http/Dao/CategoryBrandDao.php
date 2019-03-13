<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/13
 * Time: 16:35
 */

namespace App\Http\Dao;


use App\Http\Model\CategoryBrand;

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
     * CategoryBrandDao constructor.
     * @param CategoryBrand $categoryBrand
     */
    public function __construct(CategoryBrand $categoryBrand)
    {
        $this->categoryBrand = $categoryBrand;
    }
}