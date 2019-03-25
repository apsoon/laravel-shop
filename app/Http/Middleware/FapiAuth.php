<?php

namespace App\Http\Middleware;

use App\Http\Enum\StatusCode;
use App\Http\Model\User;
use App\Http\Util\JsonResult;
use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
        $requestUri = \Request::getRequestUri();
        // 特殊请求直接交给下一级处理
        if (stristr($requestUri, "order/callback") || stristr($requestUri, "user/login")) return $next($request);
        $req = $request->all();
        $rules = ['userId' => 'required', 'token' => 'required'];
        $valid = Validator::make($req, $rules);
        if ($valid->fails()) {
            exit(new JsonResult(StatusCode::AUTH_FAILED));
        }
        $user = User::where(['user_id' => $req['userId'], 'token' => $req['token']])->count();
        if ($user) {
            return $next($request);
        } else {
            exit(new JsonResult(StatusCode::AUTH_FAILED));
        }
    }
}
