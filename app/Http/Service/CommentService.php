<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 15:24
 */

namespace App\Http\Service;

use App\Http\Dao\CommentDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Comment;
use App\Http\Util\JsonResult;

class CommentService
{
    /**
     * @var CommentDao
     */
    private $commentDao;

    /**
     * 创建评论
     *
     * @param array $req
     * @return JsonResult
     */
    public function createComment(array $req)
    {
        $comments = json_decode($req["comments"]);
        $commentList = [];
        foreach ($comments as $comment) {
            array_push($commentList, ["user_id" => $req["userId"], "order_sn" => $req["orderSn"], "sku_id" => $comment->skuId, "content" => $comment->content, "sort_order" => 0, "state" => 0]);
        }
        $result = $this->commentDao->insertList($commentList);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * @param array $req
     * @return JsonResult
     */
    public function updateCommentState(array $req)
    {
        return new JsonResult();
    }

    /**
     * @param array $req
     * @return JsonResult
     */
    public function getPagedCommentList(array $req)
    {
        return new JsonResult();
    }

    /**
     * 分页获取有效到评论
     *
     * @param array $req
     * @return JsonResult
     */
    public function getPagedEffectCommentBySku(array $req)
    {
        $size = 20;
        $result = $this->commentDao->findPagedBySkuEffect($req["skuId"], $req["pageNo"], $size);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }

    /**
     * CommentService constructor.
     *
     * @param CommentDao $commentDao
     */
    public function __construct(CommentDao $commentDao)
    {
        $this->commentDao = $commentDao;
    }
}