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
use Illuminate\Support\Facades\Log;

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
        return $this->collectionService->createCollection($req);
    }

    /**
     * 删除收藏
     *
     * @param Request $request
     * @return JsonResult
     */
    public function remove(Request $request)
    {
        $req = $request->all();
        $skuIds = json_decode($req["skuIds"]);
        return $this->collectionService->removeCollection($req["userId"], $skuIds);
    }

    /**
     * 判断sku是否收藏
     *
     * @param Request $request
     * @return JsonResult
     */
    public function check(Request $request)
    {
        $req = $request->all();
        return $this->collectionService->checkCollectionByUserSku($req);
    }

    /**
     * 分页获取收藏列表
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        return $this->collectionService->getCollectionList($req);
    }

    /**
     * CollectionFapi constructor.
     *
     * @param CollectionService $collectionService
     */
    public function __construct(CollectionService $collectionService)
    {
        $this->middleware("auth-fapi");
        $this->collectionService = $collectionService;
    }
}