<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use App\Http\Service\AttributeService;
use Illuminate\Http\Request;

class AttributeMapi extends Controller
{
    /**
     * @var AttributeService
     */
    private $attributeService;

    /**
     * 获取属性列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request)
    {
        $req = $request->all();
        $result = $this->attributeService->getAttributeList($req);
        return view('admin.pages.goods.attribute_list', ["attributes" => $result]);
    }

    /**
     * AttributeMapi constructor.
     *
     * @param AttributeService $attributeService
     */
    public function __construct(AttributeService $attributeService)
    {
        $this->middleware('auth');
        $this->attributeService = $attributeService;
    }
}
