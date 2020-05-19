<?php

namespace App\Http\Controllers\Admin\Archives;

use App\Http\Requests\Admin\ArchiveRequest;
use App\Http\Response\ResponseJson;
use App\Repositories\V1\ArchivesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArchivesController extends Controller
{
    use ResponseJson;
    protected $archivesRepository;
    public function __construct(ArchivesRepository $archivesRepository)
    {
        $this->archivesRepository = $archivesRepository;
    }

    public function index()
    {
        return view('admin.archives.index');
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

}
