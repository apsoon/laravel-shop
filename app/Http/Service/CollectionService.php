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
use App\Http\Model\Collection;

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
     * @return bool
     */
    public function createCollection(array $req)
    {
        $collection = new Collection();
        $collection->user_id = $req["userId"];
        $collection->sku_id = $req["skuId"];
        $result = $this->collectionDao->insert($collection);
        return $result;
    }

    /**
     * 获取用户收藏
     *
     * @param array $req
     * @return mixed
     */
    public function getCollectionList(array $req)
    {
        $pageNo = empty($reqp["pageNo"]) ? 1 : $req["pageNo"];
        $result = $this->collectionDao->findByUserIdPaged($req["userId"], $pageNo, 20);
        foreach ($result as $collection) {
            $sku = $this->skuDao->findById($collection->sku_id);
            $collection->sku = $sku;
        }
        return $result;
    }

    /**
     * 用户删除收藏
     *
     * @param string $userId
     * @param array $skuIds
     * @return mixed
     */
    public function removeCollection(string $userId, array $skuIds)
    {
        $result = $this->collectionDao->deleteByUserSkuId($userId, $skuIds);
        return $result;
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