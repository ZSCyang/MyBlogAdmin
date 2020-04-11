<?php
/**
 * Author jintao.yang
 * User: litblc
 * Date: 2020/4/1
 * Time: 19:23
 */
namespace App\Http\Response;

trait ResponseJson
{
    /**
     * 当App接口出现业务异常的返回
     * Author jintao.yang
     * @param $code
     * @param $message
     * @param array $data
     * @return string
     */
    public function jsonData($code, $message, $data = [])
    {
        return $this->jsonResponse($code, $message, $data);
    }

    /**
     * app接口请求成功后的返回
     * Author jintao.yang
     * @param array $data
     * @return string
     */
    public function jsonSuccessData($data = [])
    {
        return $this->jsonResponse(0, 'Success', $data);
    }

    /**
     * 返回一个json
     * Author jintao.yang
     * @param $code
     * @param $message
     * @param $data
     * @return string
     */
    private function jsonResponse($code, $message, $data)
    {
        $content = [
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ];
        //return json_encode($content);
        return response()->json($content);
    }

}