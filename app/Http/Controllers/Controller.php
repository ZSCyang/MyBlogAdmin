<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Response\ResponseArray;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ResponseArray;

    /**
     * 上传base64头像
     * Author jintao.yang
     * @param Request $request
     * @return mixed
     */
    public function uploadPic($base64Img, $folder)
    {
        $base64Img = trim($base64Img);
        //允许上传的图片格式
        $filetype = ['jpg','png','jpeg'];

        if (!preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64Img, $matches)) {
            return $this->arrayData('10005', '这不是标准的base64');
        }
        //判断允许上传的文件格式
        if (!in_array($matches[2], $filetype)) {
            return $this->arrayData('10005', '上传文件格式不支持');
        }
        //获取文件后缀
        $ext = $matches[2];
        //保存图片地址
        $ymd = date("Y-m-d");
        $imgName = time().rand(10000, 99999).".".$ext;

        //存放相对路径
        $relativePath = "/uploads/".$folder."/".$ymd;
        //存放绝对路径
        $filePath = public_path().$relativePath;

        //确定保存文件的地址
        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
        }

        //去掉base64头部标识
        $base64_content = substr(strstr($base64Img, ','), 1);
        $img = base64_decode($base64_content);

        //文件绝对路径
        $savePath = $filePath.'/'.$imgName;

        //移动图片到指定文件夹
        if (!file_put_contents($savePath, $img)) {
            return $this->arrayData('10005', '图片保存失败');
        } else {
            return $this->arraySuccessData($relativePath.'/'.$imgName); //返回保存的相对路径
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


    //文件上传
    public static function uploadFile()
    {
        return 123;
        if (Request::hasFile('editormd-image-file')) {
            $pic = Request::file('editormd-image-file');
            if ($pic->isValid()) {
                //存储位置
                $path = "/uploads/markdown/" . date("Y-m-d");
                if (is_dir($path)) {
                    mkdir($path, 777);
                }
                $newName = date('Ymd-His') . '-' . rand(100, 999) . '.' . $pic->getClientOriginalExtension();
                //本地保存
                $pic->move($path, $newName);
                //{"success":1,"url":"\/upLoadsFiles\/5bdbcb266de8d68c97328f8ccbcb946e.jpg","message":"success"}
                //这个数据格式是编辑器要求的！必须按这样返回~
                //这里的success的值 必须是数值int的1或者0不然会没法回显url！1成功  0失败
                //url就是图片的路径这没啥说的，message见名知意描述啥的
                $picUrl = $path . $newName;
                return $picUrl;
                return json_encode(array(
                    'success' => 1,
                    'url' => $picUrl,
                    'message' => 'success',
                ));
            }
        }
        return json_encode(array(
            'success' => 0,
            'url' => "",
            'message' => 'error',
        ));
    }
}


