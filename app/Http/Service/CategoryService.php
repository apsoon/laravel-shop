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
        $result = $this->categoryDao->getLimitedAll($pageNo, $size);
        return $result;
    }

    /**
     * 获取合并父类的分类
     *
     * @return \App\Http\Model\Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUnitCategory()
    {
        $categories = $this->categoryDao->getAll();
        $sorted = array_values(array_sort($categories, function ($category) {
            return $category->level;
        }));
        $sorted = array_reverse($sorted);
        $result = $this->unitMultiCategory($sorted);
        return $result;
    }

    private function unitMultiCategory($categories)
    {
        $temp = [];
        foreach ($categories as $category) {
            if ($category->level == 1) {
                $res = $this->copyCategoryBean($category);
                array_push($temp, $res);
            } else {
                foreach ($categories as $item) {
                    if ($item->id == $category->parent_id) {
                        $sublist = empty($item->sublist) == 1 ? [] : $item->sublist;
                        $res_ = $this->copyCategoryBean($category);
                        array_push($sublist, $res_);
                        $sorted = array_values(array_sort($sublist, function ($cat) {
                            return $cat->sort_order;
                        }));
                        $item->sublist = $sorted;
                    }
                }
            }
        }
        $result = array_values(array_sort($temp, function ($item) {
            return $item->sort_order;
        }));
        return $result;
    }

    /**
     *
     * @param $origin
     * @return \stdClass
     */
    private function copyCategoryBean($origin)
    {
        $result = new \stdClass();
        $result->id = $origin->id;
        $result->name = $origin->name;
        $result->image_url = $origin->image_url;
        $result->sort_order = $origin->sort_order;
        $result->sublist = empty($origin->sublist) ? [] : $origin->sublist;
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