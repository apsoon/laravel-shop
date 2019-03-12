<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/12
 * Time: 11:05
 */

namespace App\Http\Dao;


use App\Http\Model\AfterSale;

/**
 * Class AfterSaleDao
 *
 * @package App\Http\Dao
 */
class AfterSaleDao
{
    /**
     * @var AfterSale
     */
    private $afterSale;

    /**
     * @param AfterSale $afterSale
     * @return AfterSale
     */
    public function insert(AfterSale $afterSale)
    {
        return $afterSale - save();
    }

    /**
     * @param AfterSale $afterSale
     * @return AfterSale
     */
    public function update(AfterSale $afterSale)
    {
        return $afterSale - save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->afterSale::where("id", "=", $id)
            ->first();
    }

    /**
     * @param string $userId
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findPagedListByUser(string $userId, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->afterSale::where("user_id", "=", $userId)
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * @param string $userId
     * @param int $state
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findPagedListByStateUser(string $userId, int $state, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->afterSale::where(["user_id" => $userId, "state" => $state])
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findPagedList(int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->afterSale::offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * @param $state
     * @param int $pageNo
     * @param int $size
     * @return mixed
     */
    public function findPagedListByState($state, int $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        $result = $this->afterSale::where("state", "=", $state)
            ->offset($offset)
            ->limit($size)
            ->get();
        return $result;
    }

    /**
     * AfterSaleDao constructor.
     *
     * @param AfterSale $afterSale
     */
    public function __construct(AfterSale $afterSale)
    {
        $this->afterSale = $afterSale;
    }
}