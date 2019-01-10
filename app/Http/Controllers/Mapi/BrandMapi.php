<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandMapi extends Controller
{
    //
    public function list()
    {
        return view('admin.pages.goods.brand_list');
    }
}
