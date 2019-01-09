<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:31
 */

namespace App\Http\Dao;

use App\Http\Model\User;

/**
 * Class UserDao
 *
 * @package App\Http\Dao
 */
class UserDao
{

    /**
     * @var User
     */
    private $user;

    /**
     * 添加用户
     *
     * @param User $user
     * @return bool
     */
    public function insert($user)
    {
        return $user->save();
    }

    /**
     * 根据 userId 查找用户
     *
     * @param String $userId
     * @return mixed
     */
    public function getByUserId($userId)
    {
        $result = $this->user::where(["open_id" => $userId])
            ->select("user_id", "token", "open_id")
            ->first();
        return $result;
    }

    /**
     * 设置用户信息
     *
     * @param $userId
     * @param $userInfo
     * @return mixed
     */
    public function updateUserInfo($userId, $userInfo)
    {
        $result = $this->user::where(["user_id" => $userId])
            ->update(["nickname" => $userInfo->nickName, "avatar_url" => $userInfo->avatarUrl, "is_auth" => 1]);
        return $result;
    }

    /**
     * 更新电话号码
     *
     * @param $userId
     * @param $phone
     * @return mixed
     */
    public function updatePhone($userId, $phone)
    {
        $result = $this->user::where(["user_id" => $userId])
            ->update(["phone" => $phone]);
        return $result;
    }

    /**
     * UserDao constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}