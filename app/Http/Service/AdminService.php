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
        if (empty($admin)) return new JsonResult(StatusCode::USER_NOT_EXIST);
        $result = new \stdClass();
        $result->hash = $admin->password;
        return new JsonResult(StatusCode::SUCCESS, $result);
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