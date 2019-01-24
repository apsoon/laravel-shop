<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 11:06
 */

namespace App\Http\Dao;


use App\Http\Model\Collection;

/**
 * Class CollectionDao
 *
 * @package App\Http\Dao
 */
class CollectionDao
{
    private $collection;

    /**
     * 添加
     *
     * @param Collection $collection
     * @return bool
     */
    public function insert(Collection $collection)
    {
        $result = $collection->save();
        return $result;
    }

    /**
     * 用户ID获取
     *
     * @param string $userId
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByUserIdPaged(string $userId, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->collection::where(["user_id" => $userId])
            ->offset($offset)
            ->limit($size)
            ->get()
            ->toArray();
        return $result;
    }

    /**
     * 根据用户ID删除
     *
     * @param string $userId
     * @return mixed
     */
    public function deleteByUserId(string $userId)
    {
        $result = $this->collection::where(["user_id" => $userId])
            ->delete();
        return $result;
    }

    /**
     * 根据用户ID和产品ID删除
     *
     * @param string $userId
     * @param array $productIds
     * @return mixed
     */
    public function deleteByUserProductId(string $userId, array $productIds)
    {
        $result = $this->collection::where(["user_id" => $userId])
            ->whereIn("product_id", $productIds)
            ->delete();
        return $result;
    }

    /**
     * CollectionDao constructor.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

}