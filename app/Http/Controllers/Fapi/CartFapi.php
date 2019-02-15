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
        $result = $this->cartService->addSkuToCart($req);
        if ($result) return new JsonResult();
        else return new JsonResult(StatusCode::SERVER_ERROR);
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
        $result = $this->cartService->getCartByUserId($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    public function delete(Request $request)
    {
        $req = $request->all();
        if (empty($req) || empty($req["skuIds"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->cartService->deleteCartSkusByUserId($req);
        if ($result) return new JsonResult();
        else return new JsonResult(StatusCode::SERVER_ERROR);
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