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
        $req = $request->all();
        // 如果是登录交给下一级处理
        if (sizeof($req) == 2 && !empty($req["name"]) && !empty($req["password"])) return $next($request);
        $rules = ['admin_id' => 'required', 'token' => 'required'];
        $valid = Validator::make($req, $rules);
        if ($valid->fails()) {
            exit(new JsonResult(StatusCode::PARAM_LACKED));
        }
        $admin = Admin::where(['id' => $req['admin_id'], 'remember_token' => $req['token']])->count();
        if ($admin) {
            return $next($request);
        } else {
            exit(new JsonResult(StatusCode::USER_NOT_EXIST));
        }
    }
}
