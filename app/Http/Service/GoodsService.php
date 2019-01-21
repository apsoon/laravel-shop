<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Service;


use App\Http\Dao\GoodsDao;
use App\Http\Dao\ProductDao;
use App\Http\Dao\ProductSpecificationOptionDao;
use App\Http\Dao\SpecificationDao;
use App\Http\Dao\SpecificationOptionDao;
use App\Http\Model\Goods;
use App\Http\Model\GoodsDetail;
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
     * @var GoodsDao
     */
    private $goodsDao;

    /**
     * @var ProductDao
     */
    private $productDao;

    /**
     * @var SpecificationDao
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
        $goods = new Goods();
        $goods->category_id = $req["category_id"];
        $goods->brand_id = $req["brand_id"];
        $goods->name = $req["name"];
        $goods->brief = $req["brief"];
        $goods->cover = "";
        $result = $this->goodsDao->insert($goods);
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
    public function getGoodsDetail(array $req)
    {
        $result = $this->goodsDao->findById($req["goods_id"]);
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
     * @param GoodsDao $goodsDao
     * @param ProductDao $productDao
     * @param SpecificationDao $specificationDao
     * @param SpecificationOptionDao $specificationOptionDao
     * @param ProductSpecificationOptionDao $productSpecificationOptionDao
     */
    public function __construct(GoodsDao $goodsDao, ProductDao $productDao, SpecificationDao $specificationDao, SpecificationOptionDao $specificationOptionDao, ProductSpecificationOptionDao $productSpecificationOptionDao)
    {
        $this->goodsDao = $goodsDao;
        $this->productDao = $productDao;
        $this->specificationDao = $specificationDao;
        $this->specificationOptionDao = $specificationOptionDao;
        $this->productSpecificationOptionDao = $productSpecificationOptionDao;
    }
}