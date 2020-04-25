<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * 统一返回格式
     * Author jintao.yang
     * @param $statusCode
     * @param $message
     * @param null $data
     * @param int $httpStatusCode
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function formatResponse($statusCode, $message, $data = null, $httpStatusCode = 200)
    {
        $respond = [
            'status_code' => $statusCode,
            'message'     => $message
        ];
        if (! is_null($data)) {
            $respond['body'] = $data;
        }
        return response() -> json($respond, $httpStatusCode) -> setCallback(app('request')->get('callback'));
    }*/

}


