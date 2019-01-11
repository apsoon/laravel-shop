<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:30
 */

namespace App\Http\Service;


use App\Http\Dao\CategoryDao;

/**
 * Class CategoryService
 *
 * @package App\Http\Service
 */
class CategoryService
{
    /**
     * @var  CategoryDao
     */
    private $categoryDao;

    /**
     * 获取所有分类
     *
     * @param $req
     * @return mixed
     */
    public function getAllCategory($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->categoryDao->getAll($pageNo, $size);
        return $result;
    }

    /**
     * 获取合并父类的分类
     *
     * @return \App\Http\Model\Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUnitCategory()
    {
        $result = $this->categoryDao->getUnitAll();
        return $result;
    }

    /**
     * CategoryService constructor.
     *
     * @param CategoryDao $categoryDao
     */
    public function __construct(CategoryDao $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }
}