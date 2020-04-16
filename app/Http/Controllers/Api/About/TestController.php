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
use App\Http\Response\ResponseJson;
use App\Common\Err\ApiErrDesc;
use App\Exceptions\ApiException;

class TestController extends Controller
{

    use ResponseJson;

    public function index()
    {
        throw new ApiException(ApiErrDesc::ERR_TOKEN);
        /*return $this->jsonSuccessData([
            'msg' => "this is about"
        ]);*/
    }

}