<?php

namespace App\Http\Controllers\Admin\Travels;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WisdomsController extends Controller
{
    public function index()
    {
        return view('admin.wisdoms.index');
    }
}
