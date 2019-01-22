<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/22
 * Time: 10:01
 */

namespace App\Http\Service;


use App\Http\Dao\AdDao;
use App\Http\Dao\AdPositionDao;
use App\Http\Model\Ad;
use Illuminate\Support\Facades\Log;

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
        $ad->name = $req["name"];
        $ad->content = $req["content"];
        $ad->sort_order = $req["sortOrder"];
        $ad->state = $req["state"];
        $result = $this->adDao->insert($ad);
        return $result;
    }

    /**
     * 获取所有
     *
     * @return Ad[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAdList()
    {
        $result = $this->adDao->findAll();
        return $result;
    }

    /**
     * 根据key获取
     *
     * @param array $req
     * @return array|mixed
     */
    public function getAdListByKey(array $req)
    {
        if (empty($req) || empty($req["key"])) return [];
        $result = $this->adDao->findByKey($req["key"]);
        return $result;
    }

    /**
     * 获取所有广告位置
     *
     * @return \App\Http\Model\AdPosition[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAdPositionList()
    {
        $result = $this->adPositionDao->findAll();
        return $result;
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