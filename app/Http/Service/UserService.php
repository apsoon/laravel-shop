<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 10:30
 */

namespace App\Http\Service;

use App\Http\Dao\UserDao;
use App\Http\Enum\StatusCode;
use App\Http\Enum\StatusMessage;
use App\Http\Model\User;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\Log;

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

    /**
     * 登录方法
     *
     * @param $info
     * @return JsonResult
     */
    public function login($info)
    {
        $code = $info['code'];
        try {
            $url = "https://api.weixin.qq.com/sns/jscode2session?appid=" . env('WX_APP_ID') . "&secret=" . env('WX_APP_SECRET') . "&js_code=$code&grant_type=authorization_code";
            $json = json_decode(file_get_contents($url));
            Log::error(" [ UserService.php ] =================== login >>>>> request wx function error, json = " . json_encode($json));
            $openid = $json->openid;
        } catch (\Exception $e) {
            Log::error(" [ UserService.php ] =================== login >>>>> request wx function error, e = " . json_encode($e));
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
        $user = $this->userDao->getByOpenId($openid);
        if ($user) {
            $result = new \stdClass();
            $result->userId = $user->user_id;
            $result->token = $user->token;
            $result->isAuth = $user->is_auth;
            return new JsonResult(StatusCode::LOGIN_SUCCESS, $result);
        } else {
            $user = new User();
            $user->open_id = $openid;
            $user->user_id = md5(uniqid());
            $user->token = md5(time() . $openid . 'xiaozhengtech');
            $user->is_auth = 0;
            $save = $this->userDao->insert($user);
            if ($save) {
                $result = new \stdClass();
                $result->userId = $user->user_id;
                $result->token = $user->token;
                $result->isAuth = $user->is_auth;
                return new JsonResult(StatusCode::REGISTER_SUCCESS, $result);
            }
        }
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * @param $info
     * @return mixed
     */
    public function setUserInfo($info)
    {
        $result = $this->userDao->updateUserInfo($info["user_id"], $info["userInfo"]);
        return $result;
    }

    public function __construct(UserDao $userDao)
    {
        $this->userDao = $userDao;
    }

}