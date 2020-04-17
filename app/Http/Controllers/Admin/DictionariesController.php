<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DictionariesController extends Controller
{
    public function articlesTypeList()
    {
        return view('admin.dictionaries.articlesTypeList');
    }


    public function archivesTypeList()
    {
        return view('admin.dictionaries.archivesTypeList');
    }
}
