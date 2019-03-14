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