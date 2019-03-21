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
        $rules = ['userId' => 'required', 'token' => 'required'];
        $valid = Validator::make($req, $rules);
        if ($valid->fails()) {
            exit(new JsonResult(StatusCode::PARAM_LACKED));
        }
        $user = User::where(['user_id' => $req['userId'], 'token' => $req['token']])->count();
        if ($user) {
            return $next($request);
        } else {
            exit(new JsonResult(StatusCode::USER_NOT_EXIST));
        }
    }
}
