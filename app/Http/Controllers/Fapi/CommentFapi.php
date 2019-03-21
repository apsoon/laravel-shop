<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 15:23
 */

namespace App\Http\Controllers\Fapi;


use App\Http\Controllers\Controller;
use App\Http\Service\CommentService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

class CommentFapi extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * 创建评论
     *
     * @param Request $request
     * @return JsonResult
     */
    public function create(Request $request)
    {
        $req = $request->all();
        return $this->commentService->createComment($req);
    }

    /**
     * 分页获取有效到评论
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        return $this->commentService->getPagedEffectCommentBySku($req);
    }

    /**
     * CommentFapi constructor.
     *
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->middleware("auth-fapi");
        $this->commentService = $commentService;
    }
}