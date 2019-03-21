<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\UserService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

class UserMapi extends Controller
{

    /**
     * @var UserService
     */
    private $userService;

    /**
     * 分页获取用户列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function listByPage(Request $request)
    {
        $req = $request->all();
        return $this->userService->getPageUserList($req);
    }

    /**
     * UserMapi constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->middleware("auth-mapi");
        $this->userService = $userService;
    }
}
