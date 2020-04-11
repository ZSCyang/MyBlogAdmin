<?php

namespace App\Http\Controllers\Auth;

use App\Common\Auth\JwtAuth;
use App\Http\Response\ResponseJson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;

class JwtLoginController extends BaseController
{
    use ResponseJson;

    public function test(Request $request)
    {
        //$username = $request->input('user_name');
        //$password = $request->input('pass_word');
        $uid = 123;
        $jwtAuth = JwtAuth::getInstance();
        $token = $jwtAuth->setUid($uid)->encode()->getToken();

        return $this->jsonSuccessData([
            'token' => $token
        ]);
    }

    public function info()
    {
        return [
            'user_name' => 'zscyang',
            'age' => 23
        ];
    }

}
