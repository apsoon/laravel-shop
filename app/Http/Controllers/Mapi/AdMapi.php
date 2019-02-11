<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\AdService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Util\Json;

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
        $adList = $this->adService->getAdList();
        return new JsonResult(StatusCode::SUCCESS, $adList);
    }

    /**
     * 添加广告
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        $positionList = $this->adService->getAdPositionList();
        return view("admin.pages.ad.ad_add", ["positionList" => $positionList]);
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
        $result = $this->adService->createAd($req);
        if ($result) return new JsonResult();
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
        $result = $this->adService->modifyState($req);
        if ($result) return new JsonResult();
    }

    /**
     * @param Request $request
     * @return JsonResult
     */
    public function delete(Request $request)
    {
        $req = $request->all();
        $result = $this->adService->deleteAd($req);
        if ($result) return new JsonResult();
    }

    /**
     * 位置列表
     *
     * @return JsonResult
     */
    public function listPosition()
    {
        $positionList = $this->adService->getAdPositionList();
        return new JsonResult(StatusCode::SUCCESS, $positionList);
    }

    /**
     * AdMapi constructor.
     * @param AdService $adService
     */
    public function __construct(AdService $adService)
    {
        $this->middleware("auth");
        $this->adService = $adService;
    }
}
