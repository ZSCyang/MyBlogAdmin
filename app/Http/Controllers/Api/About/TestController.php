<?php
/**
 * Author jintao.yang
 * User: litblc
 * Date: 2020/4/11
 * Time: 18:07
 */

namespace App\Http\Controllers\Api\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{

    public function index()
    {
        echo "this is about";
    }

}