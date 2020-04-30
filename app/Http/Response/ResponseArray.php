<?php
/**
 * Author jintao.yang
 * User: litblc
 * Date: 2020/4/28
 * Time: 20:23
 */
namespace App\Http\Response;

trait ResponseArray
{
    /**
     * 当后台函数出现业务异常的返回
     * Author jintao.yang
     * @param $code
     * @param $message
     * @param array $data
     * @return string
     */
    public function arrayData($code, $message, $data = [])
    {
        return $this->arrayResponse($code, $message, $data);
    }

    /**
     * 当后台函数请求成功后的返回
     * Author jintao.yang
     * @param array $data
     * @return string
     */
    public function arraySuccessData($data = [])
    {
        return $this->arrayResponse(200, 'Success', $data);
    }

    /**
     * 返回一个array
     * Author jintao.yang
     * @param $code
     * @param $message
     * @param $data
     * @return array
     */
    private function arrayResponse($code, $message, $data)
    {
        $content = [
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ];
        return $content;
    }

}