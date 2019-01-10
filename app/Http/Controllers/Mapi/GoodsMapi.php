<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoodsMapi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function list()
    {
        Log::info(" [ GoodsMapi.php ] =================== list >>>>>> tag ");
        return view('admin.pages.goods.goods_list');
    }
}
