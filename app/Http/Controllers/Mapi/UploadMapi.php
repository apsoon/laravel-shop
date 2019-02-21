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
        $result = new \stdClass();
        $result->filePath = Storage::putFile("ad/banner", $file);
        return new JsonResult(StatusCode::SUCCESS, $result);
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
