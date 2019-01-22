<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/22
 * Time: 10:02
 */

namespace App\Http\Dao;


use App\Http\Model\Ad;

class AdDao
{
    private $ad;

    /**
     * 添加
     *
     * @param Ad $ad
     * @return bool
     */
    public function insert(Ad $ad)
    {
        $result = $ad->save();
        return $result;
    }

    /**
     * id删除
     *
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id)
    {
        $result = $this->ad::where(["id" => $id])
            ->delete();
        return $result;
    }

    /**
     * 根据key获取
     *
     * @param string $key
     * @return mixed
     */
    public function findByKey(string $key)
    {
        $result = $this->ad::where(["key" => $key])
            ->get();
        return $result;
    }

    /**
     * 获取所有
     *
     * @return Ad[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        $result = $this->ad::all();
        return $result;
    }

    /**
     * AdDao constructor.
     *
     * @param Ad $ad
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }
}