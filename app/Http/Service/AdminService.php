<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 10:58
 */

namespace App\Http\Service;


use App\Http\Dao\AdminDao;
use App\Http\Enum\StatusCode;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Class AdminService
 * @package App\Http\Service
 */
class AdminService
{
    /**
     * @var AdminDao
     */
    private $adminDao;

    /**
     * 登录
     *
     * @param array $req
     * @return JsonResult
     */
    public function login(array $req)
    {
        $admin = $this->adminDao->findByName($req["name"]);
        if (empty($admin) || $admin->password != $req["password"]) return new JsonResult(StatusCode::ACCOUNT_OR_PWD_ERROR);
        $token = md5($req["password"] . time() . $req["name"]);
        $admin->remember_token = $token;
        $admin->save();
        unset($admin->remember_token);
        unset($admin->password);
        unset($admin->email_verified_at);
        unset($admin->updated_at);
        unset($admin->created_at);
        $admin->token = $token;
        return new JsonResult(StatusCode::SUCCESS, $admin);
    }

    /**
     * 获取用户信息
     *
     * @param array $req
     * @return JsonResult
     */
    public function getUserInfo(array $req)
    {
        $admin = $this->adminDao->findByName($req["name"]);
        if ($admin->remember_token != $req["token"]) return new JsonResult(StatusCode::PARAM_ERROR);
        return new JsonResult(StatusCode::SUCCESS, $admin);
    }

    /**
     * 创建admin
     *
     * @param array $req
     * @return JsonResult
     */
    public function createAdmin(array $req)
    {
        return new JsonResult();
    }

    /**
     * 获取admin列表
     *
     * @return JsonResult
     */
    public function getAdminList()
    {
        $adminList = $this->adminDao->findAll();
        foreach ($adminList as $admin) {
            unset($admin->password);
        }
        return new JsonResult(StatusCode::SUCCESS, $adminList);
    }

    /**
     * AdminService constructor.
     *
     * @param AdminDao $adminDao
     */
    public function __construct(AdminDao $adminDao)
    {
        $this->adminDao = $adminDao;
    }
}