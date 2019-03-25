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
use App\Http\Dao\SkuDao;
use App\Http\Dao\UserDao;
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
     * @var UserDao
     */
    private $userDao;

    /**
     * @var AfterSaleDao
     */
    private $afterSaleDao;

    /**
     * @var OrderDao
     */
    private $orderDao;

    /**
     * @var SkuDao
     */
    private $skuDao;

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

    private function createWxRefund()
    {

    }

    /**
     * 取消售后订单
     *
     * @param array $req
     * @return JsonResult
     */
    public function cancelAfterSale(array $req)
    {
        if (empty($req["userId"]) || empty($req["id"])) return new JsonResult(StatusCode::PARAM_LACKED);
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
        $result = new \stdClass();
        if ($type === "all") {
            $afSaleList = $this->afterSaleDao->findPagedList($pageNo, $size);
            $result->total = AfterSale::count();
        } else {
            $state = AfterSaleStatus::findByKey($type)["code"];
            $afSaleList = $this->afterSaleDao->findPagedListByState($state, $pageNo, $size);
            $result->total = AfterSale::where("state", "=", $state)->count();
        }
        foreach ($afSaleList as $afSale) {
            $user = $this->userDao->findByUserId($afSale->user_id);
            $afSale->nickname = $user->nickname;
            $sku = $this->skuDao->findById($afSale->sku_id);
            $afSale->sku_name = $sku->name;
        }
        $result->afSaleList = $afSaleList;
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * 修改售后订单状态
     *
     * @param array $req
     * @return JsonResult
     */
    public function updateAfterSaleState(array $req)
    {
        $result = $this->afterSaleDao->updateStateById($req["id"], $req["state"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * AfterSaleService constructor.
     *
     * @param AfterSaleDao $afterSaleDao
     * @param OrderDao $orderDao
     * @param UserDao $userDao
     * @param SkuDao $skuDao
     */
    public function __construct(AfterSaleDao $afterSaleDao, OrderDao $orderDao, UserDao $userDao, SkuDao $skuDao)
    {
        $this->afterSaleDao = $afterSaleDao;
        $this->orderDao = $orderDao;
        $this->userDao = $userDao;
        $this->skuDao = $skuDao;
    }
}