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
use App\Http\Model\Goods;
use App\Http\Model\GoodsDetail;
use App\Http\Model\Product;
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
        Log::info($req);
////        $product = new Product();
////        $product->name = $req["name"];
////        $product->goods_id = $req["goods_id"];
////        $product->origin_price = $req["origin_price"];
////        $product->price = $req["price"];
////        $result = $this->productDao->insert($product);
//        return $result;
        return 1;
    }

    /**
     * @param int $goodsId
     * @return mixed
     */
    public function getProductByGoodsId(int $goodsId)
    {
        $result = $this->productDao->findByGoodsId($goodsId);
        return $result;
    }

    // ===========================================================================  construct ===========================================================================

    /**
     * GoodsService constructor.
     *
     * @param GoodsDao $goodsDao
     * @param ProductDao $productDao
     */
    public function __construct(GoodsDao $goodsDao, ProductDao $productDao)
    {
        $this->goodsDao = $goodsDao;
        $this->productDao = $productDao;
    }
}