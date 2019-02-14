<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 15:01
 */

namespace App\Http\Service;


use App\Http\Dao\SkuDao;

class SkuService
{
    /**
     * @var SkuDao
     */
    private $skuDao;

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

    public function __construct(SkuDao $skuDao)
    {
        $this->skuDao = $skuDao;
    }
}