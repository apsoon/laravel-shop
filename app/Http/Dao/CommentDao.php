<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 14:57
 */

namespace App\Http\Dao;


use App\Http\Model\Comment;

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