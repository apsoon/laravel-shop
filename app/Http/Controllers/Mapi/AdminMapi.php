<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\AdminService;
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
     * @return \App\Http\Util\JsonResult
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
     * @return \App\Http\Util\JsonResult
     */
    public function list(Request $request)
    {
        return $this->adminService->getAdminList();
    }

    public function login(Request $request)
    {

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
        $this->adminService = $adminService;
    }
}
