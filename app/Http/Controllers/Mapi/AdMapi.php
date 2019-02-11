<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\AdService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $req = $request->all();
        $result = $this->adService->createAd($req);
        if ($result) return url("ad/list");
    }

    /**
     * 位置列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPosition()
    {
        $positionList = $this->adService->getAdPositionList();
        return view("admin.pages.ad.adPosition_list", ["positionList" => $positionList]);
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
