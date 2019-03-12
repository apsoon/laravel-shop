<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/3/12
 * Time: 11:04
 */

namespace App\Http\Service;


use App\Http\Dao\AfterSaleDao;
use App\Http\Dao\OrderDao;
use App\Http\Enum\AfterSaleStatus;
use App\Http\Enum\OrderStatus;
use App\Http\Enum\StatusCode;
use App\Http\Model\AfterSale;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\Log;

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
     * @var OrderDao
     */
    private $orderDao;

    /**
     * 创建售后
     *
     * @param array $req
     * @return JsonResult
     */
    public function createAfterSale(array $req)
    {
        if (empty($req["userId"]) || empty($req["orderSn"]) || empty($req["skuId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findBySn($req["orderSn"]);
        Log::info("=======================");
        Log::info($order);
        Log::info(empty($order));
        Log::info($order->user_id != $req["userId"]);
        Log::info(($order->state < OrderStatus::COMMENT_REQUIRED));
        if (empty($order) || $order->user_id != $req["userId"] || ($order->state < OrderStatus::COMMENT_REQUIRED["code"]))
            return new JsonResult(StatusCode::PARAM_ERROR);
        $afterSale = new AfterSale();
        $afterSale->user_id = $req["userId"];
        $afterSale->order_sn = $req["orderSn"];
        $afterSale->sku_id = $req["skuId"];
        $afterSale->reason = $req["reason"];
        $afterSale->describe = $req["describe"];
        $afterSale->state = AfterSaleStatus::ACCEPT_REQUIRED["code"];
        $result = $this->afterSaleDao->insert($afterSale);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 取消售后订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function cancelAfterSale(array $req)
    {
        if (empty($req["userId"]) || empty($req["afterSn"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $afterSale = $this->afterSaleDao->findById($req["id"]);
        if (empty($afterSale) || $afterSale->user_id != $req["userId"]) return new JsonResult(StatusCode::PARAM_ERROR);
        $afterSale->state = AfterSaleStatus::CANCEL["code"];
        $result = $this->afterSaleDao->update($afterSale);
        if ($result) return new JsonResult();
        return new JsonResult();
    }

    /**
     * 分页分状态获取售后订单
     *
     * @return JsonResult
     */
    public function getPagedASListByUserState($req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = 20;
        $type = $req["type"];
        if ($type === "all") $result = $this->afterSaleDao->findPagedListByUser($req["userId"], $pageNo, $size);
        else $result = $this->afterSaleDao->findPagedListByStateUser($req["userId"], $req["state"], $pageNo, $size);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 分页分状态获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getAsPagedListByType(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $type = $req["type"];
        if ($type === "all") $result = $this->afterSaleDao->findPagedList($pageNo, $size);
        else $result = $this->afterSaleDao->findPagedListByState(AfterSaleStatus::findByKey($type)["code"], $pageNo, $size);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * AfterSaleService constructor.
     *
     * @param AfterSaleDao $afterSaleDao
     * @param OrderDao $orderDao
     */
    public function __construct(AfterSaleDao $afterSaleDao, OrderDao $orderDao)
    {
        $this->afterSaleDao = $afterSaleDao;
        $this->orderDao = $orderDao;
    }
}