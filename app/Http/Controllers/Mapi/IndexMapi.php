<?php

namespace App\Http\Controllers\Mapi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexMapi extends Controller
{
    //
    public function index()
    {
        return view("admin.pages.index");
    }

    public function __construct()
    {
        $this->middleware("auth-mapi");
    }
}
