<?php

namespace App\Exceptions;

use App\Common\Err\ApiErrDesc;
use App\Http\Response\ResponseJson;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Exceptions\HttpResponseException;

class Handler extends ExceptionHandler
{

    use ResponseJson;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        //return parent::render($request, $exception);

        //接口异常抛出返回
        if ($exception instanceof ApiException) {
            $code = $exception->getCode();
            $message = $exception->getMessage();
        } else if ($exception instanceof ValidationException) { //字段验证异常抛出
            $message = @$exception->validator->errors()->first(); //第一个错误
            $code = 10001;
        } else {  //未知错误抛出
            return parent::render($request, $exception);
            /*$code = $exception->getCode();
            if (!$code || $code < 0) {
                $code = ApiErrDesc::UNKNOWN_ERR[0];
            }
            $message = $exception->getMessage() ?: ApiErrDesc::UNKNOWN_ERR[1];*/
        }
        return $this->jsonData($code, $message);
    }
}
