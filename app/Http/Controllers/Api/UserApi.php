<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Enum\StatusMessage;
use App\Http\Service\UserService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class UserApi
 *
 * @package App\Http\Controllers\Api
 */
class UserApi extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

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
        $result = $this->userService->login($info);
        return $result;
    }

    public function setUserInfo(Request $request)
    {
        $info = $request->all();
        if (empty($info) || empty($info["userInfo"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $this->userService->setUserInfo($info);
    }


    /**
     * UserApi constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
}
