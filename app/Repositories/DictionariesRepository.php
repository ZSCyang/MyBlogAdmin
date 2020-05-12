<?php

namespace App\Repositories;

use App\Models\Dictionarie;

class DictionariesRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Dictionarie();
    }

    /**
     * 添加字典
     * Author jintao.yang
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $data =  $this->model->allowField($data, 'dictionaries');
        $this->model->fillable(array_keys($data));
        $this->model->fill($data);
        return $this->model->save();
    }


    /**
     * 编辑封面图
     * Author jintao.yang
     * @param $data
     * @return mixed
     */
    public function edit($data)
    {
        $dictionarieModel = Dictionarie::find($data['dictionarie_id']);
        $data =  $this->model->allowField($data, 'dictionaries');
        $dictionarieModel->fillable(array_keys($data));
        $dictionarieModel->fill($data);
        return $dictionarieModel->save();
    }


    /**
     * 删除字典
     * Author jintao.yang
     * @param $dictionarieId
     * @return mixed
     */
    public function delete($dictionarieId)
    {
        $dictionarieModel = Dictionarie::find($dictionarieId);
        return $dictionarieModel->delete();
    }

}