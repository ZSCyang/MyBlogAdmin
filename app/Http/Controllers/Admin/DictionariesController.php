<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dictionarie;
use App\Repositories\DictionariesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Response\ResponseJson;
use App\Http\Requests\Admin\DictionarieRequest;

class DictionariesController extends Controller
{

    use ResponseJson;
    protected $dictionariesRepository;
    public function __construct(DictionariesRepository $dictionariesRepository)
    {
        $this->dictionariesRepository = $dictionariesRepository;
    }

    /**
     * 杂文类型列表
     * Author jintao.yang
     * @param Dictionarie $dictionarie
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function articlesTypeList(Dictionarie $dictionarie)
    {
        $articlesTypeList = $dictionarie->where('type', 2)
            ->paginate(3);
        return view('admin.dictionaries.articlesTypeList', compact('articlesTypeList'));
    }


    /**
     * 博文类型列表
     * Author jintao.yang
     * @param Dictionarie $dictionarie
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function archivesTypeList(Dictionarie $dictionarie)
    {
        $archivesTypeList = $dictionarie->where('type', 1)
            ->paginate(3);
        return view('admin.dictionaries.archivesTypeList', compact('archivesTypeList'));
    }


    /**
     * 提交新增字典
     * Author jintao.yang
     * @param DictionarieRequest $request
     * @return string
     */
    public function addPost(DictionarieRequest $request)
    {
        $data = $request->all();
        //上传图片
        $upload_result = $this->uploadPic($data['base64Img'], 'logos');

        if ($upload_result['code'] == 200) {
            $data['logo'] = $upload_result['data'];
        } else {
            return $this->jsonData('10005', $upload_result['data']);
        }
        $result = $this->dictionariesRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }


    /**
     * 提交编辑字典
     * Author jintao.yang
     * @param CoverRequest $request
     * @return string
     */
    public function editPost(DictionarieRequest $request)
    {

        $data = $request->all();
        //判断是否参数是否存在
        if (empty($data['archiveType_id']) || !is_numeric(strval($data['archiveType_id']))) {
            return $this->jsonData('10005', '参数错误，请刷新后重试');
        }
        if ($data['imgStatus'] == 2) {
            //上传图片
            $upload_result = $this->uploadPic($data['base64Img'], 'logos');
            if ($upload_result['code'] == 200) {
                $data['logo'] = $upload_result['data'];
            } else {
                return $this->jsonData('10005', $upload_result['data']);
            }
        }

        $result = $this->dictionariesRepository->edit($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '修改失败，请稍后再试');
        }
    }


}
