<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 15:26
 */

namespace App\Http\Controllers\Mapi;


use App\Http\Controllers\Controller;
use App\Http\Service\CommentService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;

class CommentMapi extends Controller
{
    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * 分页获取评论
     *
     * @param Request $request
     * @return JsonResult
     */
    public function list(Request $request)
    {
        $req = $request->all();
        return $this->commentService->getPagedCommentListByType($req);
    }

    /**
     * 修改评论状态
     *
     * @param Request $request
     * @return JsonResult
     */
    public function modifyState(Request $request)
    {
        $req = $request->all();
        return $this->commentService->updateCommentState($req);
    }

    /**
     * CommentMapi constructor.
     *
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->middleware("auth-mapi");
        $this->commentService = $commentService;
    }
}