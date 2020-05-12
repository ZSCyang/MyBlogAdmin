<?php

namespace App\Http\Controllers\Admin\Travels;

use App\Http\Requests\Admin\WisdomRequest;
use App\Models\Wisdom;
use App\Repositories\V1\WisdomsRepository;
use Illuminate\Http\Request;
use App\Http\Response\ResponseJson;
use App\Http\Controllers\Controller;

class WisdomsController extends Controller
{

    use ResponseJson;
    protected $wisdomsRepository;
    public function __construct(WisdomsRepository $wisdomsRepository)
    {
        $this->wisdomsRepository = $wisdomsRepository;
    }

    public function index(Wisdom $wisdom)
    {
        $wisdomsList = $wisdom->orderby('created_at', 'desc')
            ->paginate(3);
        return view('admin.wisdoms.index', compact('wisdomsList'));
    }


    /**
     * 提交添加智慧语录
     * Author jintao.yang
     * @param WisdomRequest $request
     * @return string
     */
    public function addPost(WisdomRequest $request)
    {
        $data = $request->all();
        $result = $this->wisdomsRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }


    /**
     * 提交编辑智慧语
     * Author jintao.yang
     * @param WisdomRequest $request
     * @return string
     */
    public function editPost(WisdomRequest $request)
    {
        $data = $request->all();
        //判断是否参数是否存在
        if (empty($data['wisdom_id']) || !is_numeric(strval($data['wisdom_id']))) {
            return $this->jsonData('10005', '参数错误，请刷新后重试');
        }
        $result = $this->wisdomsRepository->edit($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '修改失败，请稍后再试');
        }
    }


    /**
     * 提交删除智慧语
     * Author jintao.yang
     * @param Request $request
     * @return string
     */
    public function deletePost(Request $request)
    {
        $wisdomId = $request->input('wisdom_id');
        if (empty($wisdomId) || !is_numeric($wisdomId)||strpos($wisdomId, ".")!==false) {
            return $this->jsonData('10005', '参数错误，请稍后再试');
        }
        $result = $this->wisdomsRepository->delete($wisdomId);
        if ($result) {
            return $this->jsonSuccessData('200', '删除成功');
        } else {
            return $this->jsonData('10005', '删除失败，请稍后再试');
        }
    }
}
