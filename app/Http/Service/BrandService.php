<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:30
 */

namespace App\Http\Service;

use App\Http\Dao\BrandDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Brand;
use App\Http\Util\JsonResult;
use App\Http\Dao\CategoryBrandDao;
use Illuminate\Support\Facades\Log;

/**
 * Class UserService
 *
 * @package App\Http\Service
 */
class BrandService
{
    /**
     * @var BrandDao
     */
    private $brandDao;

    /**
     * @var CategoryBrandDao
     */
    private $categoryBrandDao;

    /**
     * 获取品牌列表
     *
     * @return JsonResult
     */
    public function getBrandList()
    {
        $brandList = $this->brandDao->list();
        foreach ($brandList as $brand) {
            if (!empty($brand->logo)) $brand->logo = asset( $brand->logo);
        }
        return new JsonResult(StatusCode::SUCCESS, $brandList);
    }

    /**
     * 分页获取商品列表
     *
     * @param array $info
     * @return JsonResult
     */
    public function getPagedBrandList(array $info)
    {
        $pageNo = empty($info["pageNo"]) ? 1 : $info["pageNo"];
        $size = empty($info["size"]) ? 20 : $info["size"];
        $result = new \stdClass();
        $brandList = $this->brandDao->findByPage($pageNo, $size);
        foreach ($brandList as $brand) {
            if (!empty($brand->logo)) $brand->logo = asset("storage" . $brand->logo);
        }
        $result->brandList = $brandList;
        $result->total = Brand::count();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建商标
     *
     * @param $req
     * @return JsonResult
     */
    public function createBrand($req)
    {
        $brand = new Brand();
        $brand->name = $req["name"];
        $brand->region = $req["region"];
        $brand->logo = $req["logo"];
        $brand->describe = $req["describe"];
        $brand->state = $req["state"];
        $result = $this->brandDao->insert($brand);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR, $result);
    }

    /**
     * 更新商标
     *
     * @param array $req
     * @return JsonResult
     */
    public function updateBrand(array $req)
    {
        $brand = $this->brandDao->findById($req["id"]);
        $brand->name = $req["name"];
        $brand->region = $req["region"];
        $brand->logo = $req["logo"];
        $brand->describe = $req["describe"];
        $brand->state = $req["state"];
        $result = $this->brandDao->update($brand);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR, $result);
    }

    /**
     * 修改状态
     *
     * @param array $req
     * @return bool
     */
    public function modifyState(array $req)
    {
        $result = $this->brandDao->updateStateById($req["id"], $req["state"]);
        return $result;
    }

    /**
     * 删除广告
     *
     * @param array $req
     * @return mixed
     */
    public function deleteBrand(array $req)
    {
        $ids = $req["ids"];
        if (sizeof($ids) == 1) {
            $result = $this->brandDao->deleteById($ids[0]);
        } else {
            $result = $this->brandDao->deleteByIds($ids);
        }
        return $result;
    }

    /**
     * id获取品牌
     *
     * @param array $req
     * @return JsonResult
     */
    public function getBrandById(array $req)
    {
        $result = $this->brandDao->findById($req["brandId"]);
        if (!empty($result->logo)) {
            $result->logoUrl = asset("storage" . $result->logo);
        }
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取当前分类下的品牌
     *
     * @param array $req
     * @return JsonResult
     */
    public function getBrandByCategory(array $req)
    {
        if (empty($req["categoryId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $categoryBrands = $this->categoryBrandDao->findByCategory($req["categoryId"]);
        $brandIds = [];
        foreach ($categoryBrands as $categoryBrand) {
            array_push($brandIds, $categoryBrand->brand_id);
        }
        $result = $this->brandDao->findByIdIn($brandIds);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * BrandService constructor.
     *
     * @param BrandDao $brandDao
     * @param CategoryBrandDao $categoryBrandDao
     */
    public function __construct(BrandDao $brandDao, CategoryBrandDao $categoryBrandDao)
    {
        $this->brandDao = $brandDao;
        $this->categoryBrandDao = $categoryBrandDao;
    }
}