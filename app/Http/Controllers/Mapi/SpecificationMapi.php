<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecificationMapi extends Controller
{
    //
    public function list()
    {
        return view('admin.pages.goods.specification_list');
    }
}