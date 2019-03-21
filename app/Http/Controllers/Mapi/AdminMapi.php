<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\AdminService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class AdminMapi
 *
 * @package App\Http\Controllers
 */
class AdminMapi extends Controller
{
    /**
     * @var AdminService
     */
    private $adminService;

    /**
     * 创建admin
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        return $this->adminService->createAdmin($req);
    }

    /**
     * admin列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        return $this->adminService->getAdminList();
    }

    /**
     * 登录
     *
     * @param Request $request
     * @return JsonResult
     */
    public function login(Request $request)
    {
        $req = $request->all();
        return $this->adminService->login($req);
    }

    /**
     * 获取用户信息
     * @param Request $request
     * @return  JsonResult
     */
    public function info(Request $request)
    {
        $req = $request->all();
        return $this->adminService->getUserInfo($req);
    }

    public function reset(Request $request)
    {

    }

    /**
     * AdminMapi constructor.
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->middleware("auth-mapi");
        $this->adminService = $adminService;
    }
}
