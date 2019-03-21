<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 15:06
 */

namespace App\Http\Controllers\Fapi;


use App\Http\Controllers\Controller;
use App\Http\Service\AdService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class AdFapi
 *
 * @package App\Http\Controllers\Fapi
 */
class AdFapi extends Controller
{
    /**
     * @var AdService
     */
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
        return $this->adService->getAdListByKeyEffect($req);
    }

    /**
     * AdFapi constructor.
     *
     * @param AdService $adService
     */
    public function __construct(AdService $adService)
    {
        $this->middleware("auth-fapi");
        $this->adService = $adService;
    }
}