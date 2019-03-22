<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Service;


use App\Http\Config\Config;
use App\Http\Dao\BrandDao;
use App\Http\Dao\CategoryDao;
use App\Http\Dao\SpuDao;
use App\Http\Dao\SpuDetailDao;
use App\Http\Dao\SpecDao;
use App\Http\Dao\SpuGalleryDao;
use App\Http\Dao\SpuSpecDao;
use App\Http\Dao\SpuSpecOptionDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Spu;
use App\Http\Model\SpuDetail;
use App\Http\Model\SpuGallery;
use App\Http\Model\SpuSpecOption;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class SpuService
 *
 * @package App\Http\Service
 */
class SpuService
{

    /**
     * @var SpuDao
     */
    private $spuDao;

    /**
     * @var SpuDetailDao
     */
    private $spuDetailDao;

    /**
     * @var SpuSpecDao
     */
    private $spuSpecDao;

    /**
     * @var SpuSpecOptionDao
     */
    private $spuSpecOptionDao;

    /**
     * @var SpuGalleryDao
     */
    private $spuGalleryDao;

    /**
     * @var SpecDao
     */
    private $specDao;

    /**
     * @var BrandDao
     */
    private $brandDao;

    /**
     * @var CategoryDao
     */
    private $categoryDao;

    /**
     * @param $req
     * @return JsonResult
     */
    public function createSpu($req)
    {
        $spu = new Spu();
        try {
            $spu->category_id = $req["categoryId"];
            $spu->brand_id = $req["brandId"];
            $spu->name = $req["name"];
            $result = $spu->save();
            if ($result) {
                $spuDetail = new SpuDetail();
                $spuDetail->spu_id = $spu->id;
                $spuDetail->html = $req["detailHtml"];
                $spuDetail->text = $req["detailText"];
                $result = $spuDetail->save();
            }
            if ($result) return new JsonResult();
            else throw new \Exception("failed");
        } catch (\Exception $e) {
            Log::error(" [ SpuService] ================= createSpu >>>>> error happened when create a spu ");
            Log::error(json_encode($e));
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
    }

    /**
     * 获取SPU详情
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSpuDetail(array $req)
    {
        if (empty($req["spuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $detail = $this->spuDetailDao->findBySpuId($req["spuId"]);
        return new JsonResult(StatusCode::SUCCESS, $detail);
    }

    /**
     * 更新SPU
     *
     * @param array $req
     * @return JsonResult
     */
    public function updateSpu(array $req)
    {
        if (empty($req["spuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $spu = $this->spuDao->findById($req["spuId"]);
        $detail = $this->spuDetailDao->findBySpuId($req["spuId"]);
        $spu->name = $req["name"];
        $spu->category_id = $req["categoryId"];
        $spu->brand_id = $req["brandId"];
        $spu->state = $req["state"];
        $detail->html = $req["detailHtml"];
        $detail->text = $req["detailText"];
        DB::beginTransaction();
        try {
            $spu->save();
            $detail->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
        return new JsonResult();
    }

    /**
     * 获取商品列表
     *
     * @param $req
     * @return JsonResult
     */
    public function getPagedSpuList($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $spuList = $this->spuDao->getByPage($pageNo, $size);
        $total = Spu::count();
        foreach ($spuList as $spu) {
            $cate = $this->categoryDao->findById($spu->category_id);
            $spu->category_name = $cate->name;
            $brand = $this->brandDao->findById($spu->brand_id);
            $spu->brand_name = $brand->name;
        }
        $result = new \stdClass();
        $result->spuList = $spuList;
        $result->total = $total;
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 分类分页获取上架的SPU
     *
     * @param $req
     * @return mixed
     */
    public function getPagedSpuByCategoryEffect($req)
    {
        $categoryId = $req["categoryId"];
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->spuDao->findByCategoryEffectPaged($categoryId, $pageNo, $size);
        return $result;
    }

    /**
     * id获取商品
     *
     * @param int $spuId
     * @return mixed
     */
    public function getSpuById(int $spuId)
    {
        $result = $this->spuDao->findById($spuId);
        return $result;
    }

    /**
     * 获取spu详情
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSpuWithDetail(array $req)
    {
        if (empty($req["spuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $spu = $this->spuDao->findById($req["spuId"]);
        $cate = $this->categoryDao->findById($spu->category_id);
        $spu->category_name = $cate->name;
        $brand = $this->brandDao->findById($spu->brand_id);
        $spu->brand_name = $brand->name;
        $detail = $this->spuDetailDao->findBySpuId($req["spuId"]);
        $result = new \stdClass();
        $result->spu = $spu;
        $result->detail = $detail;
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 插入列表
     *
     * @param array $req
     * @return JsonResult
     */
    public function insertSpuSpecList(array $req)
    {
        if (empty($req["spuId"]) || empty($req["specIds"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $spuId = $req["spuId"];
        $specIds = $req["specIds"];
        $relates = [];
        foreach ($specIds as $specId) {
            array_push($relates, ["spu_id" => $spuId, "spec_id" => $specId]);
        }
        $result = $this->spuSpecDao->insertList($relates);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取对应规格列表
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSpuSpecList(array $req)
    {
        $spuId = $req["spuId"];
        $spuSpecs = $this->spuSpecDao->findBySpuId($spuId);
        $specIds = [];
        foreach ($spuSpecs as $spuSpec) {
            array_push($specIds, $spuSpec->spec_id);
        }
        $result = $this->specDao->findByIds($specIds);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取带选项的规格列表
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSpuSpecListWithOption(array $req)
    {
        if (empty($req["spuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $spuId = $req["spuId"];
        $specs = $this->spuSpecDao->findBySpuId($spuId);
        $options = $this->spuSpecOptionDao->findBySpuId($spuId);
        $specIds = [];
        foreach ($specs as $spec) {
            array_push($specIds, $spec->spec_id);
        }
        $nameSpecs = $this->specDao->findByIds($specIds);
        foreach ($nameSpecs as $spec) $spec->options = [];
        foreach ($options as $option) {
            foreach ($nameSpecs as $spec) {
                if ($option->spec_id == $spec->id) {
                    $arr = $spec->options;
                    array_push($arr, $option);
                    $spec->options = $arr;
                    break;
                }
            }
        }
        return new JsonResult(StatusCode::SUCCESS, $nameSpecs);
    }

    /**
     * 获取规格的所有选项
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSpecOptionList(array $req)
    {
        $spuId = $req["spuId"];
        $specId = $req["specId"];
        $result = $this->spuSpecOptionDao->findBySpuIdSpecId($spuId, $specId);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建规格选项
     *
     * @param array $req
     * @return JsonResult
     */
    public function insertSpuSpecOption(array $req)
    {
        $option = new SpuSpecOption();
        $option->spu_id = $req["spuId"];
        $option->spec_id = $req["specId"];
        $option->name = $req["name"];
        $result = $this->spuSpecOptionDao->insert($option);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 分类获取SPU
     *
     * @param $req
     * @return mixed
     */
    public function getSpuByCategory($req)
    {
        $result = $this->spuDao->findByCategoryPaged($req["categoryId"], $req["pageNo"], $req["size"]);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取最新
     *
     * @param int $size
     * @return JsonResult
     */
    public function getLastSpu(int $size)
    {
        $result = $this->spuDao->findByCreateDesc($size);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取SPU Banner
     *
     * @param array $req
     * @return JsonResult
     */
    public function getBannerEffectList(array $req)
    {
        if (empty($req["spuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $bannerList = $this->spuGalleryDao->findBySpuIdEffect($req["spuId"]);
        if (Config::UPLOAD_TO_PUBLIC) {
            foreach ($bannerList as $banner) {
                $banner->image_url = asset( $banner->image_url);
            }
        }
        $result = array_values(array_sort($bannerList, function ($banner) {
            return $banner->sort_order;
        }));
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 获取SPU Banner
     *
     * @param array $req
     * @return JsonResult
     */
    public function getBannerListBySpu(array $req)
    {
        if (empty($req["spuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $bannerList = $this->spuGalleryDao->findBySpuId($req["spuId"]);
        if (Config::UPLOAD_TO_PUBLIC) {
            foreach ($bannerList as $banner) {
                $banner->image_url = asset( $banner->image_url);
            }
        }
        $result = array_values(array_sort($bannerList, function ($banner) {
            return $banner->sort_order;
        }));
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 创建SPU Banner
     *
     * @param array $req
     * @return JsonResult
     */
    public function createSpuBanner(array $req)
    {
        $banner = new SpuGallery();
        $banner->spu_id = $req["spuId"];
        $banner->image_url = $req["imageUrl"];
        $banner->state = $req["state"];
        $banner->sort_order = $req["sortOrder"];
        $result = $this->spuGalleryDao->insert($banner);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 修改状态
     *
     * @param array $req
     * @return JsonResult
     */
    public function modifyBannerState(array $req)
    {
        $result = $this->spuGalleryDao->updateState($req["id"], $req["state"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 更新Banner
     *
     * @param array $req
     * @return JsonResult
     */
    public function updateBanner(array $req)
    {
        $banner = $this->spuGalleryDao->findById($req["id"]);
        $banner->spu_id = $req["spuId"];
        $banner->image_url = $req["imageUrl"];
        $banner->state = $req["state"];
        $result = $this->spuGalleryDao->update($banner);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * SpuService constructor.
     *
     * @param SpecDao $specDao
     * @param SpuDao $spuDao
     * @param SpuDetailDao $spuDetailDao
     * @param SpuSpecDao $spuSpecDao
     * @param SpuSpecOptionDao $spuSpecOptionDao
     * @param SpuGalleryDao $spuGalleryDao
     * @param BrandDao $brandDao
     * @param CategoryDao $categoryDao
     */
    public function __construct(SpecDao $specDao, SpuDao $spuDao, SpuDetailDao $spuDetailDao, SpuSpecDao $spuSpecDao, SpuSpecOptionDao $spuSpecOptionDao, SpuGalleryDao $spuGalleryDao, BrandDao $brandDao, CategoryDao $categoryDao)
    {
        $this->specDao = $specDao;
        $this->spuDao = $spuDao;
        $this->spuDetailDao = $spuDetailDao;
        $this->spuSpecDao = $spuSpecDao;
        $this->spuGalleryDao = $spuGalleryDao;
        $this->spuSpecOptionDao = $spuSpecOptionDao;
        $this->brandDao = $brandDao;
        $this->categoryDao = $categoryDao;
    }
}