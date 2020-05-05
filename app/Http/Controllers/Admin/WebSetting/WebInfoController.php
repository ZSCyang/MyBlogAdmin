<?php

namespace App\Http\Controllers\Admin\WebSetting;

use App\Models\WebInfo;
use App\Repositories\V1\WebInfoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebInfoRequest;
use App\Http\Response\ResponseJson;

class WebInfoController extends Controller
{

    use ResponseJson;
    protected $webInfoRepository;
    public function __construct(WebInfoRepository $webInfoRepository)
    {
        $this->webInfoRepository = $webInfoRepository;
    }

    public function index()
    {
        $webInfo = $this->webInfoRepository->getWebInfo();
        return view('admin.webInfo.index', compact('webInfo'));
    }

    public function editPost(WebInfoRequest $request)
    {
        $data = $request->all();
        $result = $this->webInfoRepository->edit($data);

        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }



}
