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
    const AUDIT_REQUIRED = 0; // 待审核
    const DISPLAY = 1; // 展示
    const NULLIFY = 2; // 无效
}