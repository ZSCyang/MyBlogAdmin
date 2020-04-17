<?php

namespace App\Http\Controllers\Admin\WebSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavBarsController extends Controller
{
    public function index()
    {
        return view('admin.navBars.index');
    }
}
