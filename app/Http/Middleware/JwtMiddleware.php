<?php

namespace App\Http\Middleware;

use App\Common\Auth\JwtAuth;
use App\Exceptions\ApiException;
use App\Http\Response\ResponseJson;
use Closure;
use App\Common\Err\ApiErrDesc;

class JwtMiddleware
{
    use ResponseJson;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $token = $request->input('token');

        if ($token) {
            $jwtAuth = JwtAuth::getInstance();
            $jwtAuth->setToken($token);

            if ($jwtAuth->validate() && $jwtAuth->verify()) {
                return $next($request);
            } else {
                //return $this->jsonData(ApiErrDesc::ERR_PASSWORD[0], ApiErrDesc::ERR_PASSWORD[1]);
                throw new ApiException(ApiErrDesc::ERR_TOKEN);
            }
        } else {
            //return $this->jsonData(ApiErrDesc::ERR_PARAMS[0], ApiErrDesc::ERR_PARAMS[1]);
            throw new ApiException(ApiErrDesc::ERR_PARAMS);
        }
    }
}
