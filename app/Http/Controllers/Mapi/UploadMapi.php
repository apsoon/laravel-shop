<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Enum\StatusCode;
use App\Http\Service\UploadService;
use App\Http\Util\JsonResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadMapi extends Controller
{

    /**
     * @var UploadService
     */
    private $uploadService;

    /**
     * 上传图片
     *
     * @param Request $request
     * @return JsonResult
     */
    public function image(Request $request)
    {
        $req = $request->all();
        $file = $request->file("file");
        if (!$file->isValid()) {
            return new JsonResult(StatusCode::INVALID_FILE);
        }
        // 文件扩展名
        $extension = $file->getClientOriginalExtension();
        // 文件名
        $fileName = $file->getClientOriginalName();
        // 生成新的统一格式的文件名
        $newFileName = md5($fileName . time() . mt_rand(1, 10000)) . '.' . $extension;
        // 图片保存路径
        $savePath = 'images/' . $req["type"] . "/" . $req["position"];
        // Web 访问路径
        $filePath = $savePath . "/" . $newFileName;
        if ($file->storePubliclyAs($savePath, $newFileName, ['disk' => 'public'])) {
            $result = new \stdClass();
            $result->fileUrl = asset($filePath);
            $result->filePath = $filePath;
            $result->fileName = $newFileName;
            return new JsonResult(StatusCode::SUCCESS, $result);
        }
        return new JsonResult(StatusCode::SERVER_ERROR);
    }

    /**
     * UploadMapi constructor.
     *
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }
}
