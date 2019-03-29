<?php

namespace App\Http\Middleware;

use App\Http\Enum\StatusCode;
use App\Http\Model\Admin;
use App\Http\Util\JsonResult;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MapiAuth
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
        $req = $request->all();
        // 如果是登录交给下一级处理
        if ((sizeof($req) == 2 && !empty($req["name"]) && !empty($req["password"])) || stristr($requestUri, "after/callback")) return $next($request);
        $rules = ['adminId' => 'required', 'token' => 'required'];
        $valid = Validator::make($req, $rules);
        if ($valid->fails()) {
            exit(new JsonResult(StatusCode::AUTH_FAILED));
        }
        $admin = Admin::where(['id' => $req['adminId'], 'remember_token' => $req['token']])->count();
        if ($admin) {
            return $next($request);
        } else {
            exit(new JsonResult(StatusCode::AUTH_FAILED));
        }
    }
}
