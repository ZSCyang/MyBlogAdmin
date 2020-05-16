<?php

namespace App\Http\Controllers\Admin\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index()
    {
        return view('admin.articles.index');
    }

}
