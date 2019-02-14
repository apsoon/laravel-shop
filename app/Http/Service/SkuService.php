<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 15:01
 */

namespace App\Http\Service;


use App\Http\Dao\SkuDao;
use App\Http\Dao\SkuSpecOptionDao;
use App\Http\Model\Sku;

class SkuService
{
    /**
     * @var SkuDao
     */
    private $skuDao;

    private $skuSpecOptionDao;

    public function createSku(array $req)
    {
        $sku = new Sku();
        $sku->spu_id = $req["spuId"];
        $sku->name = $req["name"];
        $sku->origin_price = $req["originPrice"];
        $sku->price = $req["price"];
        $sku->number = $req["number"];
        $sku->state = $req["state"];
        $options = $req["options"];
        $optionList = [];
        if ($sku->save()) {
            foreach ($options as $option) {
                array_push($optionList, ["sku_id" => $sku->id, "option_id" => $option]);
            }
        }
        $result = $this->skuSpecOptionDao->insertList($optionList);
        return $result;
    }

    /**
     * spu id 获取
     * @param array $req
     * @return mixed
     */
    public function getSkuBySpu(array $req)
    {
        $result = $this->skuDao->findBySpuId($req["spuId"]);

        return $result;
    }

    /**
     * SkuService constructor.
     *
     * @param SkuDao $skuDao
     * @param SkuSpecOptionDao $skuSpecOptionDao
     */
    public function __construct(SkuDao $skuDao, SkuSpecOptionDao $skuSpecOptionDao)
    {
        $this->skuDao = $skuDao;
        $this->skuSpecOptionDao = $skuSpecOptionDao;
    }
}