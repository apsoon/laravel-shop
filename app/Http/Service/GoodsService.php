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
use App\Http\Model\Goods;
use App\Http\Model\SpuDetail;
use App\Http\Model\Product;
use App\Http\Model\ProductSpecificationOption;
use Illuminate\Support\Facades\Log;

/**
 * Class GoodsService
 *
 * @package App\Http\Service
 */
class GoodsService
{

    /**
     * @var SpuDao
     */
    private $goodsDao;

    /**
     * @var SpuDetailDao
     */
    private $goodsDetailDao;

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

    // ===========================================================================  goods ===========================================================================

    /**
     * @param $req
     * @return bool
     */
    public function createGoods($req)
    {
        Log::info($req);
        $goods = new Goods();
        $goods->category_id = $req["categoryId"];
        $goods->brand_id = $req["brandId"];
        $goods->name = $req["name"];
        $goods->brief = $req["brief"];
        $goods->cover = $req["cover"];
        $result = $goods->save();
        if ($result) {
            $goodsDetail = new SpuDetail();
            $goodsDetail->goods_id = $goods->id;
            $goodsDetail->html = $req["detailHtml"];
            $goodsDetail->text = $req["detailText"];
            $result = $goodsDetail->save();
        }
        return $result;
    }

    /**
     * id获取商品
     *
     * @param int $goodsId
     * @return mixed
     */
    public function getGoodsById(int $goodsId)
    {
        $result = $this->goodsDao->findById($goodsId);
        return $result;
    }

    /**
     * @param array $req
     * @return mixed
     */
    public function getGoodsWithDetail(array $req)
    {
        $goods = $this->goodsDao->findById($req["goods_id"]);
        $detail = $this->goodsDetailDao->findByGoodsId($req["goods_id"]);
        $result = new \stdClass();
        $result->goods = $goods;
        $result->detail = $detail;
        return $result;
    }

    /**
     * @param $req
     * @return mixed
     */
    public function getGoodsByCategory($req)
    {
        $result = $this->goodsDao->findByCategoryPaged($req["categoryId"], $req["pageNo"], $req["size"]);
        return $result;
    }

    /**
     * 获取商品列表
     *
     * @param $req
     * @return mixed
     */
    public function getGoodsList($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->goodsDao->getByPage($pageNo, $size);
        return $result;
    }

    /**
     * 获取最新
     *
     * @param int $size
     * @return mixed
     */
    public function getLastGoods(int $size)
    {
        $result = $this->goodsDao->findByCreateDesc($size);
        return $result;
    }

    // ===========================================================================  product ===========================================================================

    public function createProduct(array $req)
    {
        $product = new Product();
        $product->name = $req["name"];
        $product->goods_id = $req["goodsId"];
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
     * @param int $goodsId
     * @return mixed
     */
    public function getProductByGoodsId(int $goodsId)
    {
        $result = $this->productDao->findByGoodsId($goodsId);
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
     * GoodsService constructor.
     *
     * @param SpuDao $goodsDao
     * @param SpuDetailDao $goodsDetailDao
     * @param SkuDao $productDao
     * @param SpecDao $specificationDao
     * @param SpecificationOptionDao $specificationOptionDao
     * @param ProductSpecificationOptionDao $productSpecificationOptionDao
     */
    public function __construct(SpuDao $goodsDao, SpuDetailDao $goodsDetailDao, SkuDao $productDao, SpecDao $specificationDao, SpecificationOptionDao $specificationOptionDao, ProductSpecificationOptionDao $productSpecificationOptionDao)
    {
        $this->goodsDao = $goodsDao;
        $this->goodsDetailDao = $goodsDetailDao;
        $this->productDao = $productDao;
        $this->specificationDao = $specificationDao;
        $this->specificationOptionDao = $specificationOptionDao;
        $this->productSpecificationOptionDao = $productSpecificationOptionDao;
    }
}