<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/24
 * Time: 11:06
 */

namespace App\Http\Controllers\Fapi;


use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\CollectionService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

/**
 * Class CollectionFapi
 *
 * @package App\Http\Controllers\Fapi
 */
class CollectionFapi extends Controller
{
    /**
     * @var CollectionService
     */
    private $collectionService;

    /**
     * 创建
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        if (empty($req["userId"]) || empty($req["productId"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->collectionService->createCollection($req);
        if ($result) return new JsonResult(); else return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 删除收藏
     *
     * @param Request $request
     * @return JsonResult|mixed
     */
    public function remove(Request $request)
    {
        $req = $request->all();
        if (empty($req["userId"]) || empty($req["productIds"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $result = $this->collectionService->removeCollection($req["userId"], $req["productIds"]);
        if ($result) return new JsonResult(); else return new JsonResult(StatusCode::SERVER_ERROR);
    }


    /**
     * 分页获取收藏列表
     *
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->collectionService->getCollectionList($req);
        return new JsonResult(StatusCode::SUCCESS,$result);

    }

    /**
     * CollectionFapi constructor.
     *
     * @param CollectionService $collectionService
     */
    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }
}