<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/25
 * Time: 14:51
 */

namespace App\Http\Enum;


/**
 * 评价状态
 *
 * @package App\Http\Enum
 */
class CommentStatus
{
    const AUDIT_REQUIRED = ["code" => 0, "key" => "audit"]; // 待审核
    const VALID = ["code" => 1, "key" => "valid"]; // 展示
    const INVALID = ["code" => 4, "key" => "invalid"]; // 无效

    private const CommentStatusArray = [
        CommentStatus::AUDIT_REQUIRED,
        CommentStatus::VALID,
        CommentStatus::INVALID,
    ];

    /**
     * key 获取
     *
     * @param $key
     * @return mixed
     */
    public static function findByKey($key)
    {
        foreach (CommentStatus::CommentStatusArray as $status) {
            if ($status["key"] === $key) {
                return $status;
            }
        }
    }
}