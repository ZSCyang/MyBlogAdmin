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

    public function index(Request $request, Archive $archive)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $archivesList = $archive->where(function ($query) use ($typeId, $title) {
            if (!empty($typeId)) {
                $query->where('type', $typeId);
            }
            if (!empty($title)) {
                $query->where('title', 'like', "%$title%");
            }
        })
        ->orderby('created_at', 'desc')
        ->paginate(2);

        $typeList = $this->dictionariesRepository->getListByType(1);
        return view('admin.archives.index', compact('archivesList', 'typeList', 'typeId', 'title'));
    }

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


    public function add()
    {
        return view('admin.archives.add');
    }

    public function detail(Archive $archive, Request $request)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $typeList = $this->dictionariesRepository->getListByType(1);
        return view('admin.archives.detail', compact('typeId', 'title', 'typeList', 'archive'));
    }

    public function edit(Request $request)
    {
        $typeId = $request->input('type');
        $title = $request->input('title');
        $typeList = $this->dictionariesRepository->getListByType(1);
        return view('admin.archives.detail', compact('typeId', 'title', 'typeList'));
    }

}
