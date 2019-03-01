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
     * sku分页获取有效
     *
     * @param $skuId
     * @param $pageNo
     * @param int $size
     * @return mixed
     */
    public function findPagedBySkuEffect($skuId, $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        return $this->comment::where(["sku_id" => $skuId, "state" => 1])
            ->offset($offset)
            ->limit($size)
            ->get();
    }

    /**
     * 分页获取所有
     *
     * @param $pageNo
     * @param int $size
     * @return mixed
     */
    public function findByPage($pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        return $this->comment::offset($offset)
            ->limit($size)
            ->get();
    }

    /**
     * 分状态分页获取
     *
     * @param $state
     * @param $pageNo
     * @param int $size
     * @return mixed
     */
    public function findPagedListByState($state, $pageNo, int $size)
    {
        $offset = ($pageNo - 1) * $size;
        return $this->comment::where("state", "=", $state)
            ->offset($offset)
            ->limit($size)
            ->get();
    }

    /**
     * 更新状态
     *
     * @param $id
     * @param $state
     * @return mixed
     */
    public function updateStateById($id, $state)
    {
        return $this->comment::where("id", "=", $id)
            ->update(["state" => $state]);
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