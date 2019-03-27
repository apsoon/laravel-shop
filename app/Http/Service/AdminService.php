<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 10:58
 */

namespace App\Http\Service;


use App\Http\Dao\AdminDao;
use App\Http\Dao\SkuDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Admin;
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
        unset($admin->is_root);
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
        $admin = $this->adminDao->findById($req["adminId"]);
        Log::info($req);
        Log::info($admin->password);
        if (empty($admin) || $admin->is_root == 0 || $admin->password != $req["originPwd"]) return new JsonResult(StatusCode::PARAM_ERROR);
        $new = new Admin();
        $new->name = $req["name"];
        $new->email = $req["email"];
        $new->phone = $req["phone"];
        $new->password = $req["password"];
        if ($new->save()) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 更新
     *
     * @param array $req
     * @return JsonResult
     */
    public function updateAdmin(array $req)
    {
        $admin = $this->adminDao->findById($req["adminId"]);
        if (empty($admin) || $admin->password != $req["originPwd"]) return new JsonResult(StatusCode::PARAM_ERROR);
        if (!empty($req["name"])) $admin->name = $req["name"];
        if (!empty($req["email"])) $admin->email = $req["email"];
        if (!empty($req["phone"])) $admin->phone = $req["phone"];
        if (!empty($req["password"])) $admin->password = $req["password"];
        if ($admin->save()) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
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
            unset($admin->is_root);
        }
        return new JsonResult(StatusCode::SUCCESS, $adminList);
    }

    public function getAdminById(array $req)
    {
        $admin = $this->adminDao->findById($req["adminId"]);
        return new JsonResult(StatusCode::SUCCESS, $admin);
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