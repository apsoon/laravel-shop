<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 15:06
 */

namespace App\Http\Controllers\Fapi;


use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\AdService;
use App\Http\Util\JsonResult;
use http\Env\Request;

class AdFapi extends Controller
{
    private $adService;

    /**
     * 分类获取广告列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        if (empty($req) || empty($req["key"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->adService->getAdListByKey($req);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * AdFapi constructor.
     *
     * @param AdService $adService
     */
    public function __construct(AdService $adService)
    {
        $this->adService = $adService;
    }
}