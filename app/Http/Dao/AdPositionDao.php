<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/22
 * Time: 10:02
 */

namespace App\Http\Dao;


use App\Http\Model\AdPosition;

class AdPositionDao
{

    /**
     * @var AdPosition
     */
    private $adPosition;

    /**
     * 获取所有
     *
     * @return AdPosition[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        $result = $this->adPosition::all();
        return $result;
    }

    /**
     * AdPositionDao constructor.
     *
     * @param AdPosition $adPosition
     */
    public function __construct(AdPosition $adPosition)
    {
        $this->adPosition = $adPosition;
    }
}