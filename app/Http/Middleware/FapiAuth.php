<?php

namespace App\Http\Middleware;

use App\Http\Enum\StatusCode;
use App\Http\Model\User;
use App\Http\Util\JsonResult;
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
        $req = $request->all();
        // 如果是登录交给下一级处理
        if (sizeof($req) == 1 && !empty($req["code"])) return $next($request);
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
