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

    public function add($data)
    {

        $data['content'] = $data['test-editormd'];
        $data =  $this->model->allowField($data, 'archives');
        $this->model->fillable(array_keys($data));
        $this->model->fill($data);
        return $this->model->save();

    }
}