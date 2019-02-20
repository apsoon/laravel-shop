<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 11:05
 */

namespace App\Http\Controllers\Fapi;


use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\CartService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class CartFapi
 *
 * @package App\Http\Controllers\Fapi
 */
class CartFapi extends Controller
{
    /**
     * @var CartService
     */
    private $cartService;

    /**
     * 添加购物车
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        if (empty($req) || empty($req["skuId"] || empty($req["number"]))) return new JsonResult(StatusCode::PARAM_LACKED);
        return $this->cartService->addSkuToCart($req);
    }

    /**
     * 获取用户购物车
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        return $this->cartService->getCartByUserId($req);
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return JsonResult
     */
    public function delete(Request $request)
    {
        $req = $request->all();
        if (empty($req) || empty($req["skuIds"])) return new JsonResult(StatusCode::PARAM_LACKED);
        return $this->cartService->deleteCartSkusByUserId($req);
    }

    /**
     * CartFapi constructor.
     *
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
}