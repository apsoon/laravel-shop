<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 11:06
 */

namespace App\Http\Service;


use App\Http\Dao\CollectionDao;
use App\Http\Dao\SkuDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Collection;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\Log;

/**
 * Class CollectionService
 *
 * @package App\Http\Service
 */
class CollectionService
{

    /**
     * @var CollectionDao
     */
    private $collectionDao;

    /**
     * @var SkuDao
     */
    private $skuDao;

    /**
     * 创建收藏
     *
     * @param array $req
     * @return JsonResult
     */
    public function createCollection(array $req)
    {
        if (empty($req["userId"]) || empty($req["skuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $collection = new Collection();
        $collection->user_id = $req["userId"];
        $collection->sku_id = $req["skuId"];
        $result = $this->collectionDao->insert($collection);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 获取用户收藏
     *
     * @param array $req
     * @return JsonResult
     */
    public function getCollectionList(array $req)
    {
        $pageNo = empty($reqp["pageNo"]) ? 1 : $req["pageNo"];
        $collections = $this->collectionDao->findByUserIdPaged($req["userId"], $pageNo, 20);
        $result = [];
        foreach ($collections as $collection) {
            $sku = $this->skuDao->findById($collection->sku_id);
            array_push($result, $sku);
        }
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 用户删除收藏
     *
     * @param string $userId
     * @param array $skuIds
     * @return JsonResult
     */
    public function removeCollection(string $userId, array $skuIds)
    {
        if (empty($userId) || empty($skuIds)) return new JsonResult(StatusCode::PARAM_LACKED);
        if (sizeof($skuIds) == 1)
            $result = $this->collectionDao->deleteByUserSkuId($userId, $skuIds[0]);
        else {
            $result = $this->collectionDao->deleteByUserSkuIdsIn($userId, $skuIds);
        }
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 通过用户Sku获取
     *
     * @param array $req
     * @return mixed
     */
    public function checkCollectionByUserSku(array $req)
    {
        if (empty($req["userId"]) || empty($req["skuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $collection = $this->collectionDao->findByUserSku($req["userId"], $req["skuId"]);
        $result = new \stdClass();
        if (empty($collection)) $result->isCollected = 0;
        else $result->isCollected = 1;
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * CollectionService constructor.
     *
     * @param CollectionDao $collectionDao
     * @param SkuDao $skuDao
     */
    function __construct(CollectionDao $collectionDao, SkuDao $skuDao)
    {
        $this->collectionDao = $collectionDao;
        $this->skuDao = $skuDao;
    }
}