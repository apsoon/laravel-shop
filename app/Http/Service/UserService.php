<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:30
 */

namespace App\Http\Service;

use App\Http\Dao\UserDao;

/**
 * Class UserService
 *
 * @package App\Http\Service
 */
class UserService
{
    /**
     * @var UserDao
     */
    private $userDao;


    public function setUserInfo($info)
    {

    }

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }
}