<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Service;


use App\Http\Dao\SpuDao;
use App\Http\Dao\SpuDetailDao;
use App\Http\Dao\SkuDao;
use App\Http\Dao\ProductSpecificationOptionDao;
use App\Http\Dao\SpecDao;
use App\Http\Dao\SpecificationOptionDao;
use App\Http\Dao\SpuSpecDao;
use App\Http\Model\Spu;
use App\Http\Model\SpuDetail;
use App\Http\Model\Product;
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

    private $spuSpecDao;

    /**
     * @var SkuDao
     */
    private $productDao;

    /**
     * @var SpecDao
     */
    private $specificationDao;

    /**
     * @var SpecificationOptionDao
     */
    private $specificationOptionDao;

    /**
     * @var ProductSpecificationOptionDao
     */
    private $productSpecificationOptionDao;

    // ===========================================================================  spu ===========================================================================

    /**
     * @param $req
     * @return bool
     */
    public function createSpu($req)
    {
        Log::info($req);
        $spu = new Spu();
        $spu->category_id = $req["categoryId"];
        $spu->brand_id = $req["brandId"];
        $spu->name = $req["name"];
        $spu->brief = $req["brief"];
        $spu->cover = $req["cover"];
        $result = $spu->save();
        if ($result) {
            $spuDetail = new SpuDetail();
            $spuDetail->spu_id = $spu->id;
            $spuDetail->html = $req["detailHtml"];
            $spuDetail->text = $req["detailText"];
            $result = $spuDetail->save();
        }
        return $result;
    }


    /**
     * 获取商品列表
     *
     * @param $req
     * @return mixed
     */
    public function getPagedSpuList($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->spuDao->getByPage($pageNo, $size);
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
     * @param array $req
     * @return mixed
     */
    public function getSpuWithDetail(array $req)
    {
        $spu = $this->spuDao->findById($req["spuId"]);
        $detail = $this->spuDetailDao->findBySpuId($req["spuId"]);
        $result = new \stdClass();
        $result->spu = $spu;
        $result->detail = $detail;
        return $result;
    }

    /**
     * 插入列表
     *
     * @param array $req
     * @return bool
     */
    public function insertSpuSpecList(array $req)
    {
        $spuId = $req["spuId"];
        $specIds = $req["specIds"];
        $relates = [];
        foreach ($specIds as $specId) {
            array_push($relates, ["spu_id" => $spuId, "spec_id" => $specId]);
        }
        $result = $this->spuSpecDao->insertList($relates);
        return $result;
    }

    /**
     * 获取对应列表列表
     *
     * @param array $req
     * @return mixed
     */
    public function getSpuSpecList(array $req)
    {
        $spuId = $req["spuId"];
        $result = $this->spuSpecDao->findBySpuId($spuId);
        return $result;
    }

    /**
     * @param $req
     * @return mixed
     */
    public function getSpuByCategory($req)
    {
        $result = $this->spuDao->findByCategoryPaged($req["categoryId"], $req["pageNo"], $req["size"]);
        return $result;
    }


    /**
     * 获取最新
     *
     * @param int $size
     * @return mixed
     */
    public function getLastSpu(int $size)
    {
        $result = $this->spuDao->findByCreateDesc($size);
        return $result;
    }

    // ===========================================================================  product ===========================================================================

    public function createProduct(array $req)
    {
        $product = new Product();
        $product->name = $req["name"];
        $product->spu_id = $req["spuId"];
        $product->origin_price = $req["originPrice"];
        $product->price = $req["price"];
        $result = $product->save();
        $options = [];
        if ($result) {
            foreach ($req["options"] as $option) {
                array_push($options, ["product_id" => $product->id, "specification_id" => $option["specificationId"], "specification_option_id" => $option["optionId"]]);
            }
        }
        $result = $this->productSpecificationOptionDao->insertList($options);
        return $result;
    }

    /**
     * @param int $spuId
     * @return mixed
     */
    public function getProductBySpuId(int $spuId)
    {
        $result = $this->productDao->findBySpuId($spuId);
        foreach ($result as $product) {
            $specifications = $this->productSpecificationOptionDao->findByProductId($product->id);
            foreach ($specifications as $specification) {
                $specification->name = $this->specificationDao->findById($specification->specification_id)->name;
                $specification->option = $this->specificationOptionDao->findById($specification->specification_option_id)->name;
            }
            $product->specifications = $specifications;
        }
        return $result;
    }

    // ===========================================================================  construct ===========================================================================

    /**
     * SpuService constructor.
     *
     * @param SpuDao $spuDao
     * @param SpuDetailDao $spuDetailDao
     * @param SkuDao $productDao
     * @param SpecDao $specificationDao
     * @param SpecificationOptionDao $specificationOptionDao
     * @param ProductSpecificationOptionDao $productSpecificationOptionDao
     */
    public function __construct(SpuDao $spuDao, SpuDetailDao $spuDetailDao, SpuSpecDao $spuSpecDao, SkuDao $productDao, SpecDao $specificationDao, SpecificationOptionDao $specificationOptionDao, ProductSpecificationOptionDao $productSpecificationOptionDao)
    {
        $this->spuDao = $spuDao;
        $this->spuDetailDao = $spuDetailDao;
        $this->spuSpecDao = $spuSpecDao;
        $this->productDao = $productDao;
        $this->specificationDao = $specificationDao;
        $this->specificationOptionDao = $specificationOptionDao;
        $this->productSpecificationOptionDao = $productSpecificationOptionDao;
    }
}