<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/22
 * Time: 10:01
 */

namespace App\Http\Service;


use App\Http\Config\Config;
use App\Http\Dao\AdDao;
use App\Http\Dao\AdPositionDao;
use App\Http\Enum\AdPosition;
use App\Http\Enum\StatusCode;
use App\Http\Model\Ad;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\Log;

/**
 * Class AdService
 *
 * @package App\Http\Service
 */
class AdService
{
    /**
     * @var AdDao
     */
    private $adDao;

    /**
     * @var AdPositionDao
     */
    private $adPositionDao;

    /**
     * 创建广告
     *
     * @param array $req
     * @return mixed
     */
    public function createAd(array $req)
    {
        $ad = new Ad();
        $ad->position_id = $req["positionId"];
        $ad->key = AdPosition::findByCode($req["positionId"])["key"];
        $ad->name = $req["name"];
        $ad->content = $req["content"];
        $ad->sort_order = $req["sortOrder"];
        $ad->image_url = $req["imageUrl"];
        $ad->link_type = $req["linkType"];
        $ad->sku_id = $req["skuId"];
        $ad->state = $req["state"];
        $result = $this->adDao->insert($ad);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 更新广告
     *
     * @param array $req
     * @return JsonResult
     */
    public function updateAd(array $req)
    {
        $ad = $this->adDao->findById($req["id"]);
        $ad->position_id = $req["positionId"];
        $ad->key = AdPosition::findByCode($req["positionId"])["code"];
        $ad->name = $req["name"];
        $ad->content = $req["content"];
        $ad->sort_order = $req["sortOrder"];
        $ad->image_url = $req["imageUrl"];
        $ad->link_type = $req["linkType"];
        $ad->sku_id = $req["skuId"];
        $ad->state = $req["state"];
        $result = $this->adDao->update($ad);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取所有广告
     *
     * @return JsonResult
     */
    public function getPagedAdList()
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = 20;
        $adList = $this->adDao->findByPage($pageNo, $size);
        if (Config::UPLOAD_TO_PUBLIC) {
            foreach ($adList as $ad) {
                $ad->image_url = asset($ad->image_url);
            }
        }
        $result = new \stdClass();
        $result->adList = $adList;
        $result->total = Ad::count();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 根据key获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getAdListByKey(array $req)
    {
        if (empty($req["key"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->adDao->findByKey($req["key"]);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }


    /**
     * 根据key获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getAdListByKeyEffect(array $req)
    {
        if (empty($req["key"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $adList = $this->adDao->findByKeyEffect(AdPosition::findByKey($req["key"])["code"]);
        Log::info($adList);
        foreach ($adList as $ad) {
            $ad->image_url = empty($ad->image_url) ? "" : asset($ad->image_url);
        }
        return new JsonResult(StatusCode::SUCCESS, $adList);
    }


    /**
     * 修改状态
     *
     * @param array $req
     * @return JsonResult
     */
    public function modifyState(array $req)
    {
        if (empty($req["id"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->adDao->updateStateById($req["id"], $req["state"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * @return JsonResult
     *
     * 获取所有广告位置
     */
    public function getAdPositionList()
    {
        $result = $this->adPositionDao->findAll();
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 删除广告
     *
     * @param array $req
     * @return JsonResult
     */
    public function deleteAd(array $req)
    {
        if (empty($req["ids"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $ids = $req["ids"];
        if (sizeof($ids) == 1) {
            $result = $this->adDao->deleteById($ids[0]);
        } else {
            $result = $this->adDao->deleteByIds($ids);
        }
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 广告详情
     *
     * @param array $req
     * @return JsonResult
     */
    public function getAdById(array $req)
    {
        if (empty($req["adId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->adDao->findById($req["adId"]);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * AdService constructor.
     *
     * @param AdDao $adDao
     * @param AdPositionDao $adPositionDao
     */
    public function __construct(AdDao $adDao, AdPositionDao $adPositionDao)
    {
        $this->adDao = $adDao;
        $this->adPositionDao = $adPositionDao;
    }
}