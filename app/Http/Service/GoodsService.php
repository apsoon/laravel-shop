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

class GoodsService
{

    /**
     * @var GoodsDao
     */
    private $goodsDao;

    public function createGoods($req)
    {
        $goods = new Goods();

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