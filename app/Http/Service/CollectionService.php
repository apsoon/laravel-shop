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
    private $productDao;

    /**
     * 创建收藏
     *
     * @param array $req
     * @return bool
     */
    public function createCollection(array $req)
    {
        $collection = new Collection();
        $result = $collection->save();
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
            $product = $this->productDao->findById($collection->product_id);
            $collection->product = $product;
        }
        return $result;
    }

    /**
     * 用户删除收藏
     *
     * @param string $userId
     * @param array $productIds
     * @return mixed
     */
    public function removeCollection(string $userId, array $productIds)
    {
        $result = $this->collectionDao->deleteByUserProductId($userId, $productIds);
        return $result;
    }

    /**
     * CollectionService constructor.
     *
     * @param CollectionDao $collectionDao
     * @param SkuDao $productDao
     */
    function __construct(CollectionDao $collectionDao, SkuDao $productDao)
    {
        $this->collectionDao = $collectionDao;
        $this->productDao = $productDao;
    }
}