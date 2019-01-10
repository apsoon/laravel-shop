<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryMapi extends Controller
{
    //
    public function list()
    {
        return view('admin.pages.goods.category_list');
    }
}
