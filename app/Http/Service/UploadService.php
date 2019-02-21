<?php
/**
 * Created by PhpStorm.
 * User: wangwenchao
 * Date: 2019/2/20
 * Time: 19:53
 */

namespace App\Http\Service;


use App\Http\Enum\StatusCode;
use App\Http\Util\JsonResult;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UploadService
{

    /**
     * 上传图片
     *
     * @param array $req
     * @param $file
     * @return JsonResult
     */
    public function uploadImage(array $req, File $file)
    {
        if (!$file->isVlaid()) {
            return new JsonResult(StatusCode::INVALID_FILE);
        }
        $result = Storage::putFile("ad/banner", $file);
        return new JsonResult(StatusCode::SUCCESS, $result);
    }
}