<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 15:24
 */

namespace App\Http\Service;

use App\Http\Dao\CommentDao;
use App\Http\Dao\SkuDao;
use App\Http\Dao\UserDao;
use App\Http\Enum\StatusCode;
use App\Http\Model\Comment;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\Log;

/**
 * Class CommentService
 *
 * @package App\Http\Service
 */
class CommentService
{
    /**
     * @var UserDao
     */
    private $userDao;

    /**
     * @var CommentDao
     */
    private $commentDao;

    /**
     * @var SkuDao
     */
    private $skuDao;

    /**
     * 创建评论
     *
     * @param array $req
     * @return JsonResult
     */
    public function createComment(array $req)
    {
        Log::info($req);
        $comments = json_decode($req["comments"]);
        Log::info($comments);
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
        $result = $this->commentDao->updateStateById($req["id"], $req["state"]);
        if ($result) return new JsonResult();
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * 分页获取列表
     *
     * @param array $req
     * @return JsonResult
     */
    public function getPagedCommentList(array $req)
    {
        $size = 20;
        $comments = $this->commentDao->findByPage($req["pageNo"], $size);
        foreach ($comments as $comment) {
            $user = $this->userDao->findByUserId($comment->user_id);
            $comment->nickname = $user->nickname;
            $sku = $this->skuDao->findById($comment->sku_id);
            $comment->sku_name = $sku->name;
        }
        return new JsonResult(StatusCode::SUCCESS, $comments);
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
     * @param UserDao $userDao
     * @param SkuDao $skuDao
     */
    public function __construct(CommentDao $commentDao, UserDao $userDao, SkuDao $skuDao)
    {
        $this->commentDao = $commentDao;
        $this->userDao = $userDao;
        $this->skuDao = $skuDao;
    }
}