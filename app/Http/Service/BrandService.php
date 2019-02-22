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
     * 获取品牌列表
     *
     * @return JsonResult
     */
    public function getBrandList()
    {
        $brandList = $this->brandDao->list();
        foreach ($brandList as $brand) {
            if (!empty($brand->logo)) $brand->logo = asset($brand->logo);
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
        $brandList = $this->brandDao->findByPage($pageNo, $size);
        foreach ($brandList as $brand) {
            if (!empty($brand->logo)) $brand->logo = asset($brand->logo);
        }
        return new JsonResult(StatusCode::SUCCESS, $brandList);
    }

    /**
     * 创建商标
     *
     * @param $req
     * @return bool
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
        return $result;
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
        if (!empty($result->logo)) $result->logo = asset($result->logo);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * BrandService constructor.
     *
     * @param BrandDao $brandDao
     */
    public function __construct(BrandDao $brandDao)
    {
        $this->brandDao = $brandDao;
    }
}