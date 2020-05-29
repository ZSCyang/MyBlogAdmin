<?php

namespace App\Repositories\V1;

use App\Models\Archive;
use Illuminate\Mail\Markdown;

class ArchivesRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Archive();
    }

    /**
     * 添加博文
     * Author jintao.yang
     * @param $data
     * @return bool
     */
    public function add($data)
    {

        $data['content'] = $data['test-editormd'];
        $data =  $this->model->allowField($data, 'archives');
        $this->model->fillable(array_keys($data));
        $this->model->fill($data);
        return $this->model->save();
    }


    public function edit($data)
    {
        $data['content'] = $data['test-editormd'];
        $archive = Archive::find($data['archive_id']);
        $data =  $archive->allowField($data, 'archives');
        $archive->fillable(array_keys($data));
        $archive->fill($data);
        return $archive->save();
    }
}