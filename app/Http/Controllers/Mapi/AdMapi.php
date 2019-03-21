<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\AdService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

/**
 * Class AdMapi
 *
 * @package App\Http\Controllers\Mapi
 */
class AdMapi extends Controller
{
    /**
     * @var AdService
     */
    private $adService;

    /**
     * 广告位置
     *
     * @return JsonResult
     */
    public function list()
    {
        return $this->adService->getAdList();
    }

    /**
     * 创建广告
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        return $this->adService->createAd($req);
    }

    /**
     * 修改广告
     *
     * @param Request $request
     * @return JsonResult
     */
    public function update(Request $request)
    {
        $req = $request->all();
        return $this->adService->updateAd($req);
    }

    /**
     * 修改状态
     *
     * @param Request $request
     * @return JsonResult
     */
    public function modifyState(Request $request)
    {
        $req = $request->all();
        return $this->adService->modifyState($req);
    }

    /**
     * 删除广告
     *
     * @param Request $request
     * @return JsonResult
     */
    public function delete(Request $request)
    {
        $req = $request->all();
        return $this->adService->deleteAd($req);
    }

    /**
     * 广告详情
     *
     * @param Request $request
     * @return JsonResult
     */
    public function detail(Request $request)
    {
        $req = $request->all();
        return $this->adService->getAdById($req);
    }

    /**
     * 位置列表
     *
     * @return JsonResult
     */
    public function listPosition()
    {
        return $this->adService->getAdPositionList();
    }

    /**
     * AdMapi constructor.
     *
     * @param AdService $adService
     */
    public function __construct(AdService $adService)
    {
        $this->middleware("auth-fapi");
        $this->adService = $adService;
    }
}
