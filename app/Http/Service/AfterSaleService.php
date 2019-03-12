<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/12
 * Time: 11:04
 */

namespace App\Http\Service;


use App\Http\Dao\AfterSaleDao;
use App\Http\Util\JsonResult;

/**
 * Class AfterSaleService
 *
 * @package App\Http\Service
 */
class AfterSaleService
{
    /**
     * @var AfterSaleDao
     */
    private $afterSaleDao;

    /**
     * 创建售后
     *
     * @param array $req
     * @return JsonResult
     */
    public function createAfterSale(array $req)
    {
        return new JsonResult();
    }

    /**
     * 取消售后订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function cancelAfterSale(array $req)
    {
        return new JsonResult();
    }

    /**
     * 分页分状态获取售后订单
     *
     * @return JsonResult
     */
    public function getPagedASListByUserState($req)
    {
        return new JsonResult();
    }

    /**
     * AfterSaleService constructor.
     *
     * @param AfterSaleDao $afterSaleDao
     */
    public function __construct(AfterSaleDao $afterSaleDao)
    {
        $this->afterSaleDao = $afterSaleDao;
    }
}