<?php

namespace App\Http\Middleware;

use App\Http\Enum\StatusCode;
use App\Http\Model\User;
use App\Http\Util\JsonResult;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Closure;
use Illuminate\Support\Facades\Validator;

class FapiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $req = $request->all();
//        $rules = ['userId' => 'required', 'token' => 'required'];
//        $valid = Validator::make($req, $rules);
//        if ($valid->fails()) {
//            return json_encode(['code' => '400', 'message' => '缺少必要参数'], JSON_UNESCAPED_UNICODE);
//            return new JsonResult(StatusCode::PARAM_LACKED);
//        }
//        $user = User::where(['user_id' => $req['userId'], 'token' => $req['token']])->count();
//        if ($user) {
        return $next($request);
//        } else {
//            return json_encode(['code' => '402', 'message' => '没有此用户'], JSON_UNESCAPED_UNICODE);
//            return new JsonResult(StatusCode::USER_NOT_EXIST);
//        }
    }
}
