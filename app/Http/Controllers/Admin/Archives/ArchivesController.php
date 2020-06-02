<?php

namespace App\Http\Controllers\Admin\Archives;

use App\Http\Requests\Admin\ArchiveRequest;
use App\Http\Response\ResponseJson;
use App\Models\Archive;
use App\Repositories\DictionariesRepository;
use App\Repositories\V1\ArchivesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchivesController extends Controller
{
    use ResponseJson;
    protected $archivesRepository;
    protected $dictionariesRepository;
    public function __construct(ArchivesRepository $archivesRepository, DictionariesRepository $dictionariesRepository)
    {
        $this->archivesRepository = $archivesRepository;
        $this->dictionariesRepository = $dictionariesRepository;
    }

    /**
     * 博文列表页
     * Author jintao.yang
     * @param Request $request
     * @param Archive $archive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Archive $archive)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $status = $request->input('status');
        $archivesList = $archive->where(function ($query) use ($typeId, $title) {
            if (!empty($typeId)) {
                $query->where('type', $typeId);
            }
            if (!empty($title)) {
                $query->where('title', 'like', "%$title%");
            }
        })
        ->where(function ($query) use ($status) {
            if (!empty($status)) {
                $query->where('status', $status);
            }
        })
        ->orderby('created_at', 'desc')
        ->paginate(2);

        $typeList = $this->dictionariesRepository->getListByType(1);
        return view('admin.archives.index', compact('archivesList', 'typeList', 'typeId', 'title', 'status'));
    }


    /**
     * 提交博文
     * Author jintao.yang
     * @param ArchiveRequest $request
     * @return string
     */
    public function addPost(ArchiveRequest $request)
    {
        $data = $request->all();
        $result = $this->archivesRepository->add($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }


    /**
     * 提交博文页面
     * Author jintao.yang
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        return view('admin.archives.add');
    }


    /**
     * 博文详情
     * Author jintao.yang
     * @param Archive $archive
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Archive $archive, Request $request)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $typeList = $this->dictionariesRepository->getListByType(1);
        return view('admin.archives.detail', compact('typeId', 'title', 'typeList', 'archive'));
    }

    /**
     * 博文编辑页面
     * Author jintao.yang
     * @param Archive $archive
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Archive $archive, Request $request)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $typeList = $this->dictionariesRepository->getListByType(1);
        return view('admin.archives.edit', compact('typeId', 'title', 'typeList', 'archive'));
    }


    /**
     * 提交编辑博文
     * Author jintao.yang
     * @param ArchiveRequest $request
     * @return string
     */
    public function editPost(ArchiveRequest $request)
    {
        $data = $request->all();
        //判断是否参数是否存在
        if (empty($data['archive_id']) || !is_numeric(strval($data['archive_id']))) {
            return $this->jsonData('10005', '参数错误，请刷新后重试');
        }
        $result = $this->archivesRepository->edit($data);
        if ($result) {
            return $this->jsonSuccessData();
        } else {
            return $this->jsonData('10005', '添加失败，请稍后再试');
        }
    }

}
