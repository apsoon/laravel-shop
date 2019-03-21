<?php

namespace App\Http\Middleware;

use App\Http\Enum\StatusCode;
use App\Http\Model\Admin;
use App\Http\Util\JsonResult;
use Closure;
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
//        $req = $request->all();
//        $rules = ['admin_id' => 'required', 'token' => 'required'];
//        $valid = Validator::make($req, $rules);
//        if ($valid->fails()) {
//            return new JsonResult(StatusCode::PARAM_LACKED);
//        }
//        $admin = Admin::where(['id' => $req['admin_id'], 'remember_token' => $req['token']])->count();
//        if ($admin) {
            return $next($request);
//        } else {
//            return new JsonResult(StatusCode::USER_NOT_EXIST);
//        }
    }
}
