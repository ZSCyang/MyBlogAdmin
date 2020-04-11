<?php
/**
 * Author jintao.yang
 * User: litblc
 * Date: 2020/4/2
 * Time: 19:53
 */

namespace App\Exceptions;

use Throwable;

class ApiException extends \RuntimeException
{
    public function __construct(array $apiErrconst, Throwable $previous = null)
    {
        $code = $apiErrconst[0];
        $message = $apiErrconst[1];
        parent::__construct($message, $code, $previous);
    }

}