<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/19
 * Time: 16:24
 */

namespace App\Http\Enum;


/**
 * 广告位置
 *
 * @package App\Http\Enum
 */
class AdPosition
{
    // banner
    const BANNER = [
        "key" => "banner",
        "code" => 1
    ];

    private const AdPositionArray = [
        AdPosition::BANNER,
    ];

    /**
     * key 获取
     *
     * @param $key
     * @return mixed
     */
    public static function findByKey($key)
    {
        foreach (AdPosition::AdPositionArray as $status) {
            if ($status["key"] === $key) {
                return $status;
            }
        }
    }

    /**
     * code 获取
     *
     * @param $code
     * @return mixed
     */
    public static function findByCode($code)
    {
        foreach (AdPosition::AdPositionArray as $status) {
            if ($status["code"] === $code) {
                return $status;
            }
        }
    }
}