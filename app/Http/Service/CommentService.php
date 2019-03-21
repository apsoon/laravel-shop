<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 15:24
 */

namespace App\Http\Service;

use App\Http\Dao\CommentDao;
use App\Http\Dao\OrderDao;
use App\Http\Dao\SkuDao;
use App\Http\Dao\UserDao;
use App\Http\Enum\CommentStatus;
use App\Http\Enum\OrderStatus;
use App\Http\Enum\StatusCode;
use App\Http\Model\Comment;
use App\Http\Util\JsonResult;
use Illuminate\Support\Facades\DB;
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
     * @var OrderDao
     */
    private $orderDao;

    /**
     * 创建评论
     *
     * @param array $req
     * @return JsonResult
     */
    public function createComment(array $req)
    {
        if (empty($req["orderSn"]) || empty($req["comments"])) return new JsonResult(StatusCode::PARAM_LACKED);
        $order = $this->orderDao->findBySn($req["orderSn"]);
        if (empty($order) || $order->user_id != $req["userId"] || $order->state != OrderStatus::COMMENT_REQUIRED["code"]) return new JsonResult(StatusCode::PARAM_ERROR);
        $comments = json_decode($req["comments"]);
        $commentList = [];
        foreach ($comments as $comment) {
            array_push($commentList, ["user_id" => $req["userId"], "order_sn" => $req["orderSn"],
                "sku_id" => $comment->skuId, "content" => $comment->content, "sort_order" => 0, "rating" => $comment->rating, "state" => 0]);
        }
        DB::beginTransaction();
        try {
            $this->commentDao->insertList($commentList);
            $order->state = OrderStatus::COMPLETE["code"];
            $order->save();
            DB::commit();
        } catch (\Exception $e) {
            Log::info(" [ CommentService.php ] ================== createComment >>>>> error happened when create comment ");
            Log::info($e);
            DB::rollBack();
            return new JsonResult(StatusCode::SERVER_ERROR);
        }
        return new JsonResult();
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
     * 分页获取列表分状态获取
     *
     * @param array $req
     * @return JsonResult
     */
    public function getPagedCommentListByType(array $req)
    {
        $pageNo = empty($req["pageNo"]) ? 1 : $req["pageNo"];
        $size = empty($req["size"]) ? 20 : $req["size"];
        $type = $req["type"];
        if ($type === "all") $comments = $this->commentDao->findByPage($pageNo, $size);
        else $comments = $this->commentDao->findPagedListByState(CommentStatus::findByKey($type)["code"], $pageNo, $size);
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
        $comments = $this->commentDao->findPagedBySkuEffect($req["skuId"], $req["pageNo"], $size);
        foreach ($comments as $comment) {
            $user = $this->userDao->findByUserId($comment->user_id);
            $comment->nickname = $user->nickname;
        }
        return new JsonResult(StatusCode::SUCCESS, $comments);
    }

    /**
     * CommentService constructor.
     *
     * @param CommentDao $commentDao
     * @param UserDao $userDao
     * @param SkuDao $skuDao
     * @param OrderDao $orderDao
     */
    public function __construct(CommentDao $commentDao, UserDao $userDao, SkuDao $skuDao, OrderDao $orderDao)
    {
        $this->commentDao = $commentDao;
        $this->userDao = $userDao;
        $this->skuDao = $skuDao;
        $this->orderDao = $orderDao;
    }
}