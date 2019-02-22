<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/23
 * Time: 19:03
 */

namespace App\Http\Service;


use App\Http\Dao\CouponDao;
use App\Http\Dao\UserCouponDao;
use App\Http\Enum\CouponSendType;
use App\Http\Enum\StatusCode;
use App\Http\Enum\UserCouponStatus;
use App\Http\Model\Coupon;
use App\Http\Model\UserCoupon;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use function PHPSTORM_META\type;

class CouponService
{

    /**
     * @var CouponDao
     */
    private $couponDao;

    /**
     * @var UserCouponDao
     */
    private $userCouponDao;

    /**
     * 创建优惠券
     *
     * @param $req
     * @return JsonResult
     */
    public function createCoupon($req)
    {
        try {
            $coupon = new Coupon();
            $coupon->name = $req["name"];
            $coupon->sn = $req["sn"];
            $coupon->describe = $req["describe"];
            $coupon->is_number_limit = $req["isNumberLimit"];
            $coupon->number = $req["number"];
            $coupon->is_usage_limit = $req["isUsageLimit"];
            $coupon->usage_value = $req["usageValue"];
            $coupon->discount_type = $req["discountType"];
            $coupon->value = $req["value"];
            $coupon->discount = $req["discount"];
            $coupon->effect_start = date('Y-m-d H:i:s', $req["effectStart"] / 1000);
            $coupon->effect_end = date('Y-m-d H:i:s', $req["effectEnd"] / 1000);
            $coupon->send_type = $req["sendType"];
            $coupon->password = $req["password"];
            $coupon->state = $req["state"];
            $result = $coupon->save();
            if ($result) return new JsonResult(StatusCode::SUCCESS, $result);
        } catch (\Exception $e) {
            Log::info(" [ CouponService.php ] ================== createCoupon >>>>>> error happened when create coupon e = " . $e);
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 分页获取优惠券列表
     *
     * @param array $req
     * @return JsonResult
     */
    public function getPagedCouponList(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = 20;
        $result = $this->couponDao->findByPage($pageNo, $size);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    public function updateCoupon()
    {
    }

    /**
     * 优惠码获取
     *
     * @param string $code
     * @return mixed
     */
    public function getCouponByCode(string $code)
    {
        $result = $this->couponDao->findByCode($code);
        return $result;
    }

    /**
     * ID 获取
     *
     * @param int $id
     * @return mixed
     */
    public function getCouponById(int $id)
    {
        $result = $this->couponDao->findById($id);
        return $result;
    }

    /**
     * 获取用户不同状态的优惠券
     *
     * @param array $req
     * @return JsonResult
     */
    public function getPagedCouponListByStateUser(array $req)
    {
        if (empty($req["pageNo"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $size = 20;
        $coupons = $this->userCouponDao->findByStateUser($req["userId"], $req["state"], $req["pageNo"], $size);
        Log::info($coupons);
        foreach ($coupons as $coupon) {
            $detail = $this->couponDao->findById($coupon->id);
            $coupon->detail = $detail;
        }
        return new JsonResult(StatusCode::SUCCESS, $coupons);
    }

    /**
     * 用户获取优惠券
     *
     * @param array $req
     * @return JsonResult
     */
    public function addCouponToUser(array $req)
    {
        if (empty($req["type"]) || empty($req["value"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $coupon = null;
        switch ($req["type"]) {
            case CouponSendType::USER_RECEIVE["key"]:
            case CouponSendType::SYSTEM_SEND["key"]:
                $coupon = $this->couponDao->findById($req["value"]);
                break;
            case CouponSendType::PASSWORD["key"]:
                $coupon = $this->couponDao->findByPasswordEffect($req["value"]);
                if (empty($coupon) || $coupon->send_type != CouponSendType::PASSWORD["code"]) {
                    return new JsonResult(StatusCode::COUPON_NOT_EXIST);
                }
                break;
        }
        // 优惠券是否存在
        if (empty($coupon)) {
            return new JsonResult(StatusCode::COUPON_NOT_EXIST);
        }
        // 是否已领取
        $exist = $this->userCouponDao->findByCouponUser($coupon->id, $req["userId"]);
        if (sizeof($exist) > 0) {
            return new JsonResult(StatusCode::COUPON_ALREADY_OBTAIN);
        }
        // 优惠券数量
        if ($coupon->number <= 0) {
            return new JsonResult(StatusCode::COUPON_NOT_REST);
        }
        DB::beginTransaction();
        try {
            $decrement = $this->couponDao->decreaseNumber($coupon->id, 1);
            if (!$decrement) {
                DB::rollBack();
                return new JsonResult(StatusCode::COUPON_NOT_REST);
            }
            $userCoupon = new UserCoupon();
            $userCoupon->user_id = $req["userId"];
            $userCoupon->coupon_id = $coupon->id;
            $userCoupon->state = UserCouponStatus::NEW;
            $obtain = $userCoupon->save();
            Log::info($obtain);
            if (!$obtain) {
                DB::rollBack();
                return new JsonResult(StatusCode::SERVER_ERROR);
            }
            DB::commit();
            return new JsonResult(StatusCode::SUCCESS);
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return new JsonResult(StatusCode::SERVER_ERROR);
    }


    /**
     * CouponService constructor.
     *
     * @param CouponDao $couponDao
     * @param UserCouponDao $userCouponDao
     */
    public function __construct(CouponDao $couponDao, UserCouponDao $userCouponDao)
    {
        $this->couponDao = $couponDao;
        $this->userCouponDao = $userCouponDao;
    }
}