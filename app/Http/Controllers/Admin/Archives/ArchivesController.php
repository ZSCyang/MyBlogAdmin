<?php

namespace App\Http\Controllers\Admin\Archives;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchivesController extends Controller
{
    public function index()
    {
        return view('admin.archives.index');
    }
}
