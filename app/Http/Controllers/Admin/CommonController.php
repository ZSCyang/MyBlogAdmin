<?php

namespace App\Http\Controllers\Admin;

use App\Http\Response\ResponseJson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{
    use ResponseJson;

    /**
     * markdown上传File文件
     * Author jintao.yang
     * @param Request $request
     */
    public function uploadFileByMarkdown(Request $request)
    {

        $message='';
        if ($request->hasFile('editormd-image-file')) {
            $pic = $request->file('editormd-image-file');
            if ($pic->isValid()) {
                //存储位置
                $path = "/uploads/markdown/" . date("Y-m-d");
                $this->mkdirs($path);
                $newName = date('Ymd-His') . '-' . rand(100, 999) . '.' . $pic->getClientOriginalExtension();
                //本地保存
                if ($pic->move(public_path().$path, $newName)) {
                    $url = $path ."/". $newName;
                } else {
                    $message="系统异常，文件保存失败";
                }
            } else {
                $message = "文件无效";
            }
        } else {
            $message="请重新选择文件上传";
        }

        //{"success":1,"url":"\/upLoadsFiles\/5bdbcb266de8d68c97328f8ccbcb946e.jpg","message":"success"}
        //这个数据格式是编辑器要求的！必须按这样返回~
        $data = array(
            'success' => empty($message) ? 1 : 0,  //1：上传成功  0：上传失败
            'message' => $message,
            'url' => !empty($url) ? $url : ''
        );
        header('Content-Type:application/json;charset=utf8');
        exit(json_encode($data));
    }


    /**
     * markdown上传base64图片
     * Author jintao.yang
     * @param Request $request
     * @return string
     */
    public function uploadBase64ByMarkdown(Request $request)
    {
        $base64Img = trim($request->input('image_base64'));
        //允许上传的图片格式
        $filetype = ['jpg','png','jpeg'];

        if (!preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64Img, $matches)) {
            return $this->jsonResponse('10005', '这不是标准的base64');
        }
        //判断允许上传的文件格式
        if (!in_array($matches[2], $filetype)) {
            return $this->jsonResponse('10005', '上传文件格式不支持');
        }

        //确定保存文件的地址
        $path = "/uploads/markdown/" . date("Y-m-d");
        $this->mkdirs($path);

        //获取文件后缀
        $ext = $matches[2];
        //保存图片地址
        $newName = date('Ymd-His') . '-' . rand(100, 999) . '.' . $ext;
        //图片保存位置
        $savePath = $path."/".$newName;


        //去掉base64头部标识
        $base64_content = substr(strstr($base64Img, ','), 1);
        $img = base64_decode($base64_content);

        //移动图片到指定文件夹
        if (!file_put_contents(public_path().$savePath, $img)) {
            return $this->arrayData('10005', '图片保存失败');
        } else {
            return $this->jsonSuccessData($savePath); //返回保存的相对路径
        }

        //对图片进行压缩
        //压缩图片
        /*        $img = Image::make($img);
                $width = $img->width() / 2.5;
                $height = $img->height() / 2.5;
                $img->resize($width, $height);
                $img = $img->encode('jpg');*/
        //$rootPathdds = Image::make($img)->resize(500, 500);
        //给压缩后的图片起个新名字
        //$imgNames = "123".time().rand(10000,99999).'.jpg';
        //$a = public_path()."/uploads/transitImg/".$imgNames;
        //保存到指定文件夹
        //$rootPathdds->save($a);
        //保存为字节流的方式
        //$img =  $img->encode('jpg');
    }


    private function mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) {
            return true;
        }
        if (!mkdirs(dirname($dir), $mode)) {
            return false;
        }
        return @mkdir($dir, $mode);
    }
}
