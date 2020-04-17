<?php

namespace App\Http\Controllers\Admin\WebSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebInfoController extends Controller
{
    public function index()
    {
        return view('admin.webInfo.index');
    }
}
