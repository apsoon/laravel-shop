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
use App\Http\Dao\SkuSpecOptionDao;
use App\Http\Dao\SpecDao;
use App\Http\Dao\SpuSpecOptionDao;
use App\Http\Model\Sku;

/**
 * Class SkuService
 *
 * @package App\Http\Service
 */
class SkuService
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
     * @var SkuDao
     */
    private $skuDao;

    /**
     * @var SpecDao
     */
    private $specDao;

    /**
     * @var SpuSpecOptionDao
     */
    private $spuSpecOptionDao;

    /**
     * @var SkuSpecOptionDao
     */
    private $skuSpecOptionDao;

    /**
     * 创建产品
     *
     * @param array $req
     * @return bool
     */
    public function createSku(array $req)
    {
        $sku = new Sku();
        $sku->name = $req["name"];
        $sku->spu_id = $req["spuId"];
        $sku->origin_price = $req["originPrice"];
        $sku->price = $req["price"];
        $result = $sku->save();
        $options = [];
        if ($result) {
            foreach ($req["options"] as $option) {
                if ($option == null) continue;
                array_push($options, ["sku_id" => $sku->id, "option_id" => $option]);
            }
        }
        $result = $this->skuSpecOptionDao->insertList($options);
        return $result;
    }

    /**
     * @param int $spuId
     * @return mixed
     */
    public function getSkuBySpuId(int $spuId)
    {
        $result = $this->skuDao->findBySpuId($spuId);
        foreach ($result as $sku) {
            $specs = $this->skuSpecOptionDao->findBySkuId($sku->id);
            foreach ($specs as $spec) {
                $spec->name = $this->specDao->findById($spec->spec_id)->name;
                $spec->option = $this->specOptionDao->findById($spec->spec_option_id)->name;
            }
            $sku->specs = $specs;
        }
        return $result;
    }

    /**
     * SpuService constructor.
     *
     * @param SpuDao $spuDao
     * @param SpuDetailDao $spuDetailDao
     * @param SkuDao $skuDao
     * @param SpecDao $specDao
     * @param SpuSpecOptionDao $spuSpecOptionDao
     * @param SkuSpecOptionDao $skuSpecOptionDao
     */
    public function __construct(SpuDao $spuDao, SpuDetailDao $spuDetailDao, SkuDao $skuDao, SpecDao $specDao, SpuSpecOptionDao $spuSpecOptionDao, SkuSpecOptionDao $skuSpecOptionDao)
    {
        $this->spuDao = $spuDao;
        $this->spuDetailDao = $spuDetailDao;
        $this->skuDao = $skuDao;
        $this->specDao = $specDao;
        $this->spuSpecOptionDao = $spuSpecOptionDao;
        $this->skuSpecOptionDao = $skuSpecOptionDao;
    }
}