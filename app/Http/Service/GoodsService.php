<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/14
 * Time: 15:38
 */

namespace App\Http\Service;


use App\Http\Dao\GoodsDao;
use App\Http\Model\Goods;

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
     * @param $req
     * @return bool
     */
    public function createGoods($req)
    {
        $goods = new Goods();
        $goods->category_id = $req["categoryId"];
        $goods->brand_id = $req["brandId"];
        $goods->name = $req["name"];
        $goods->brief = $req["brief"];
        $goods->number = $req["number"];
        $goods->origin_price = $req["originPrice"];
        $goods->price = $req["price"];
        $goods->cover = $req["cover"];
        $goods->state = $req["state"];
        $result = $this->goodsDao->insert($goods);
        return $result;
    }


    public function getGoodsDetail(array $req)
    {
        $result = $this->goodsDao->findById($req->id);
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
     * GoodsService constructor.
     * @param GoodsDao $goodsDao
     */
    public function __construct(GoodsDao $goodsDao)
    {
        $this->goodsDao = $goodsDao;
    }
}