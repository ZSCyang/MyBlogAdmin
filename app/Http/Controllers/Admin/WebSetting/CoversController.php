<?php

namespace App\Http\Controllers\Admin\WebSetting;

use App\Repositories\V1\CoversRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Response\ResponseJson;
use App\Http\Requests\Admin\CoverRequest;

use App\Models\Cover;

class CoversController extends Controller
{

    use ResponseJson;
    protected $navbarsRepository;
    public function __construct(CoversRepository $coversRepository)
    {
        $this->coversRepository = $coversRepository;
    }

    /**
     * Author jintao.yang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Cover $cover)
    {
        $coversList = $cover->orderBy('created_at', 'desc')
            ->paginate(3);
        return view('admin.covers.index', compact('coversList'));
    }


    /**
     * 提交添加封面图
     * Author jintao.yang
     * @param CoverRequest $request
     * @return string
     */
    public function addPost(CoverRequest $request)
    {
        $data = $request->all();
        //上传图片
        $upload_result = $this->uploadPic($data['base64Img']);

        if ($upload_result['code'] == 200) {
            $data['pic'] = $upload_result['data'];
        } else {
            return $this->jsonData('10005', $upload_result['data']);
        }
        $result = $this->coversRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }

    /**
     * 提交编辑封面图
     * Author jintao.yang
     * @param CoverRequest $request
     * @return string
     */
    public function editPost(CoverRequest $request)
    {

        $data = $request->all();
        //判断是否参数是否存在
        if (empty($data['cover_id']) || !is_numeric(strval($data['cover_id']))) {
            return $this->jsonData('10005', '参数错误，请刷新后重试');
        }
        if ($data['imgStatus'] == 2) {
            //上传图片
            $upload_result = $this->uploadPic($data['base64Img']);
            if ($upload_result['code'] == 200) {
                $data['pic'] = $upload_result['data'];
            } else {
                return $this->jsonData('10005', $upload_result['data']);
            }
        }

        $result = $this->coversRepository->edit($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '修改失败，请稍后再试');
        }
    }


    /**
     * 提交删除封面图
     * Author jintao.yang
     * @param Request $request
     * @return string
     */
    public function deletePost(Request $request)
    {
        $coverId = $request->input('cover_id');
        if (empty($coverId) || !is_numeric($coverId)||strpos($coverId, ".")!==false) {
            return $this->jsonData('10005', '参数错误，请稍后再试');
        }
        $result = $this->coversRepository->delete($coverId);
        if ($result) {
            return $this->jsonSuccessData('200', '删除成功');
        } else {
            return $this->jsonData('10005', '删除失败，请稍后再试');
        }
    }
}
