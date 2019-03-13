<?php

namespace App\Http\Controllers\Fapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\AddrService;
use App\Http\Service\UserService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class UserApi
 *
 * @package App\Http\Controllers\Api
 */
class UserFapi extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var AddrService
     */
    private $addrService;

    /**
     * 登录方法
     *
     * @param Request $request
     * @return JsonResult
     */
    public function login(Request $request)
    {
        $info = $request->all();
        if (empty($info)) return new JsonResult(StatusCode::PARAM_LACKED);
        elseif (empty($info["code"])) return new JsonResult(StatusCode::WX_CODE_LACKED);
        return $this->userService->login($info);

    }

    /**
     * 设置用户信息
     *
     * @param Request $request
     * @return JsonResult
     */
    public function setUserInfo(Request $request)
    {
        $req = $request->all();
        return $this->userService->setUserInfo($req);
    }

    /**
     * 创建地址
     *
     * @param Request $request
     * @return JsonResult
     */
    public function createAddrs(Request $request)
    {
        $req = $request->all();
        $result = $this->addrService->insertAddrList($req);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * UserFapi constructor.
     *
     * @param UserService $userService
     * @param AddrService $addrService
     */
    public function __construct(UserService $userService, AddrService $addrService)
    {
        $this->userService = $userService;
        $this->addrService = $addrService;
    }
}
