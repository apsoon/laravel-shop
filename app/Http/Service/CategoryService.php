<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:30
 */

namespace App\Http\Service;


use App\Http\Dao\CategoryDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Category;
use App\Http\Util\JsonResult;

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
     * 创建分类
     *
     * @param array $req
     * @return JsonResult
     */
    public function createCategory(array $req)
    {
        $category = new Category();
        $category->name = $req["name"];
        $category->sort_order = empty($req["sortOrder"]) ? 1 : $req["sortOrder"];
        if (empty($req["parentId"])) {
            $category->level = 1;
            $category->parent_id = 0;
            $category->is_recom = $req["isRecom"];
        } else {
            $cat = $this->categoryDao->findById($req["parentId"]);
            $category->parent_id = $req["parentId"];
            $category->level = $cat->level + 1;
        }
        $category->image_url = $req["imageUrl"];
        $result = $this->categoryDao->insert($category);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取首页热推
     *
     * @return JsonResult
     */
    public function getRecomCategoryList()
    {
        $result = $this->categoryDao->findRecomList();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 删除分类
     *
     * @param array $req
     * @return JsonResult
     */
    public function deleteCategoryById(array $req)
    {
        if (empty($req["id"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->categoryDao->deleteById($req["id"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 设置分类热推
     *
     * @param array $req
     * @return JsonResult
     */
    public function modifyCategoryRecom(array $req)
    {
        $result = $this->categoryDao->modifyRecomById($req["id"], $req["isRecom"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取树形分类
     *
     * @return JsonResult
     */
    public function getCategoryTreeList()
    {
        $categories = $this->categoryDao->list();
        $sorted = array_values(array_sort($categories, function ($category) {
            return $category->level;
        }));
        $sorted = array_reverse($sorted);
        $result = $this->treeCategoryList($sorted);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 树形化分类
     *
     * @param $categories
     * @return array
     */
    private function treeCategoryList($categories)
    {
        $temp = [];
        foreach ($categories as $category) {
            if (!empty($category->image_url) && !strpos($category->image_url, 'http')) $category->image_url = asset("storage" . $category->image_url);
            if ($category->level == 1) {
                $res = $category;
                array_push($temp, $res);
            } else {
                foreach ($categories as $item) {
                    if ($item->id == $category->parent_id) {
                        $children = empty($item->children) == 1 ? [] : $item->children;
                        $res_ = $category;
                        array_push($children, $res_);
                        $sorted = array_values(array_sort($children, function ($cat) {
                            return $cat->sort_order;
                        }));
                        $item->children = $sorted;
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
     * CategoryService constructor.
     *
     * @param CategoryDao $categoryDao
     */
    public function __construct(CategoryDao $categoryDao)
    {
        $this->categoryDao = $categoryDao;
    }
}