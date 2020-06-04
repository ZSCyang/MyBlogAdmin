<?php

namespace App\Repositories\V1;

use App\Models\About;

class AboutRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new About();
    }


    public function getAbout()
    {
        return $this->model->first();
    }

    public function edit($data)
    {
        $about = About::find(1);
        $data =  $about->allowField($data, 'abouts');
        $about->fillable(array_keys($data));
        $about->fill($data);
        return $about->save();
    }
}