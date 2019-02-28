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
use App\Http\Enum\StatusCode;
use App\Http\Model\Sku;
use App\Http\Util\JsonResult;

/**
 * Class SkuService
 *
 * @package App\Http\Service
 */
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
     * @return JsonResult
     */
    public function createSku(array $req)
    {
        try {
            $sku = new Sku();
            $sku->spu_id = $req["spuId"];
            $sku->name = $req["name"];
            $sku->origin_price = $req["originPrice"];
            $sku->price = $req["price"];
            $sku->number = $req["number"];
            $sku->state = $req["state"];
            $sku->is_recom = 0;
            $options = $req["options"];
            $optionList = [];
            if ($sku->save()) {
                foreach ($options as $option) {
                    array_push($optionList, ["sku_id" => $sku->id, "option_id" => $option]);
                }
            }
            $result = $this->skuSpecOptionDao->insertList($optionList);
            if ($result) return new JsonResult();
        } catch (\Exception $e) {
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * spu id 获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSkuBySpu(array $req)
    {
        $skuList = $this->skuDao->findBySpuId($req["spuId"]);
        foreach ($skuList as $sku) {
            $sku->specList = $this->getSpecOptionBySku($sku->id);
        }
        return new JsonResult(StatusCode::SUCCESS, $skuList);
    }

    /**
     * id获取SKU
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSkuById(array $req)
    {
        if (empty($req["skuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->skuDao->findById($req["skuId"]);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * spu id 获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getSkuListBySpuIdEffect(array $req)
    {
        if (empty($req["spuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $skuList = $this->skuDao->findBySpuIdEffect($req["spuId"]);
        foreach ($skuList as $sku) {
            $sku->specList = $this->getSpecOptionBySku($sku->id);
        }
        return new JsonResult(StatusCode::SUCCESS, $skuList);
    }

    /**
     * 分类分页获取上架的SPU
     *
     * @param $req
     * @return JsonResult
     */
    public function getPagedSkuByCategoryEffect($req)
    {
        if (empty($req["categoryId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $categoryId = $req["categoryId"];
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = 20;
        $result = $this->skuDao->findByCategoryEffectPaged($categoryId, $pageNo, $size);
        return new JsonResult(StatusCode::SUCCESS, $result);
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
     * 获取热推商品
     *
     * @return JsonResult
     */
    public function getRecomSkuList()
    {
        $result = $this->skuDao->findByRecomEffect();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 设置SKU是否热推
     *
     * @param array $req
     * @return JsonResult
     */
    public function modifySkuRecom(array $req)
    {
        $result = $this->skuDao->modifyRecomById($req["id"], $req["isRecom"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 设置SKU状态
     *
     * @param array $req
     * @return JsonResult
     */
    public function modifySkuState(array $req)
    {
        $result = $this->skuDao->modifyState($req["id"], $req["state"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
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