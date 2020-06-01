<?php

namespace App\Http\Controllers\Admin;

use App\Http\Response\ResponseJson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{
    use ResponseJson;

    public function uploadFileByMarkdown(Request $request)
    {
        $this->disk = Storage::disk('public');
        $path = "/uploads/markdown/" . date("Y-m-d");
        if (!$this->disk->exists($path)) {
            $this->disk->makeDirectory($path);
        }
        return 888;

        $message='';
        if ($request->hasFile('editormd-image-file')) {
            $pic = $request->file('editormd-image-file');
            if ($pic->isValid()) {
                //存储位置
                $path = "/uploads/markdown/" . date("Y-m-d");
                if (!is_dir($path)) {
                    mkdir($path, 777);
                }
                $newName = date('Ymd-His') . '-' . rand(100, 999) . '.' . $pic->getClientOriginalExtension();
                //本地保存
                if ($pic->move($path, $newName)) {
                    $url = $path . $newName;
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
}
