<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Requests\Admin\AboutRequest;
use App\Http\Response\ResponseJson;
use App\Repositories\V1\AboutRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{

    use ResponseJson;
    protected $aboutRepository;
    public function __construct(AboutRepository $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    public function index()
    {
        $about = $this->aboutRepository->getAbout();
        return view('admin.about.index', compact('about'));
    }

    public function editPost(AboutRequest $request)
    {
        $data = $request->all();
        //上传背景图
        if ($data['background_imgStatus'] == 2) {
            //上传图片
            $upload_result = $this->uploadPic($data['background_base64'], 'abouts');
            if ($upload_result['code'] == 200) {
                $data['background'] = $upload_result['data'];
            } else {
                return $this->jsonData('10005', $upload_result['data']);
            }
        }

        //上传头像
        if ($data['pic_imgStatus'] == 2) {
            //上传图片
            $upload_result = $this->uploadPic($data['pic_base64'], 'abouts');
            if ($upload_result['code'] == 200) {
                $data['pic'] = $upload_result['data'];
            } else {
                return $this->jsonData('10005', $upload_result['data']);
            }
        }

        //上传微信二维码
        if ($data['qr_code_imgStatus'] == 2) {
            //上传图片
            $upload_result = $this->uploadPic($data['qr_code_base64'], 'abouts');
            if ($upload_result['code'] == 200) {
                $data['qr_code'] = $upload_result['data'];
            } else {
                return $this->jsonData('10005', $upload_result['data']);
            }
        }

        $result = $this->aboutRepository->edit($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '修改失败，请稍后再试');
        }
    }
}
