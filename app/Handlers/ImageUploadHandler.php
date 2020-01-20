<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/11/12
 * Time: 下午6:03
 */

namespace App\Handlers;


class ImageUploadHandler
{
    // 只允许以下后缀名的图片文件上传
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    /**
     * @param $file  文件名称
     * @param $folder 空间名称
     * @return array|bool
     */
    public function save($file, $folder)
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym", time()) . '/'.date("d", time()).'/';

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = time() . '_' . str_random(10) . '.' . $extension;

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        return [
            'path' => "/$folder_name/$filename"
        ];
    }


    /**
     * 上传base64的图片
     * Author jintao.yang
     * @param $base64_file
     * @param $folder
     * @return array
     */
    public function save_base64($base64_file, $folder){
        //去除头部，只要base的内容
        $base64 = trim($base64_file);
        $base64 = substr(strstr($base64,','),1);
        $img = base64_decode($base64);

        // 文件夹切割能让查找效率更高。
        $folder_name = "uploads/images/$folder/" . date("Ym", time()) . '/'.date("d", time()).'/';
        //文件目录不存在则创建
        is_dir($folder_name) OR mkdir($folder_name, 0777, true);

        //保存的图片名
        $filename = $filename = time() . '_' . str_random(10) . '.jpg';
        $upload_path = public_path() . '/'.$folder_name.$filename;
        //移动图片到指定文件夹
        file_put_contents($upload_path, $img);//返回的是字节数
        return [
            'path' => "/$folder_name/$filename"
        ];
    }
}