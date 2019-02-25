<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 14:57
 */

namespace App\Http\Dao;


use App\Http\Model\Comment;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentDao
 *
 * @package App\Http\Dao
 */
class CommentDao
{
    /**
     * @var Comment
     */
    private $comment;

    /**
     * 添加评论
     *
     * @param Comment $comment
     * @return bool
     */
    public function insert(Comment $comment)
    {
        return $comment->save();
    }

    /**
     * 批量添加
     *
     * @param array $commentList
     * @return bool
     */
    public function insertList(array $commentList)
    {
        return DB::table($this->comment->getTable())->insert($commentList);
    }

    /**
     * SKU获取
     *
     * @param int $skuId
     * @return mixed
     */
    public function findBySkuEffect(int $skuId)
    {
        return $this->comment::where(["sku_id" => $skuId, "state" => 1]);
    }

    /**
     * CommentDao constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}