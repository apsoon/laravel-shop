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

    /**
     * @var SkuSpecOptionDao
     */
    private $skuSpecOptionDao;

    /**
     * 创建sku
     *
     * @param array $req
     * @return bool
     */
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
        $skuList = $this->skuDao->findBySpuId($req["spuId"]);
        foreach ($skuList as $sku) {
            $sku->specList = $this->getSpecOptionBySku($sku->id);
        }
        return $skuList;
    }

    /**
     * id获取SKU
     *
     * @param array $req
     * @return mixed
     */
    public function getSkuById(array $req)
    {
        $result = $this->skuDao->findById($req["skuId"]);
        return $result;
    }

    /**
     * spu id 获取
     * @param array $req
     * @return mixed
     */
    public function getSpuBySpuIdEffect(array $req)
    {
        $skuList = $this->skuDao->findBySpuIdEffect($req["spuId"]);
        foreach ($skuList as $sku) {
            $sku->specList = $this->getSpecOptionBySku($sku->id);
        }
        return $skuList;
    }

    /**
     * 分类分页获取上架的SPU
     *
     * @param $req
     * @return mixed
     */
    public function getPagedSkuByCategoryEffect($req)
    {
        $categoryId = $req["categoryId"];
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $result = $this->skuDao->findByCategoryEffectPaged($categoryId, $pageNo, $size);
        return $result;
    }

    /**
     * skuId 获取规格
     *
     * @param int $skuId
     * @return mixed
     */
    public function getSpecOptionBySku(int $skuId)
    {
        $specOptionList = $this->skuSpecOptionDao->findBySkuId($skuId);
        return $specOptionList;
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