<?php

namespace App\Http\Controllers\Admin\WebSetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoversController extends Controller
{
    public function index()
    {
        return view('admin.covers.index');
    }
}
