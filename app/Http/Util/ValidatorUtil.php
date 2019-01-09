<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/1/9
 * Time: 16:28
 */

namespace App\Http\Util;


use Illuminate\Validation\Validator;

/**
 * Class ValidatorUtil
 *
 * @package App\Http\Util
 */
class ValidatorUtil
{
    /**
     * validate
     *
     * @param $data
     * @param $rules
     * @return mixed
     */
    public static function validate($data, $rules)
    {
        $validator = Validator::make($data, $rules);
        return $validator->fails();
    }
}