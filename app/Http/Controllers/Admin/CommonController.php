<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function uploadFileByMarkdown(Request $request)
    {
        return json_encode(array(
            'success' => 1,
            'url' => 123,
            'message' => 'success',
        ));
    }
}
