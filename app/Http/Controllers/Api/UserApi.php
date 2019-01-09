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

    //
    public function login(Request $request)
    {
        $info = $request->all();
        if (empty($info)) return new JsonResult(StatusCode::PARAM_LACKED, StatusMessage::PARAM_LACKED);
    }

    public function setUserInfo(Request $request)
    {
        $info = $request->all();
        if (empty($info) || empty($info["userInfo"])) return;
        $this->userService->setUserInfo($info);

    }

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
}
