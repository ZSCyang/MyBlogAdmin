<?php

namespace App\Repositories\V1;

use App\Models\Port;

class PortsRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Port();
    }

    /**
     * 添加博文
     * Author jintao.yang
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $data =  $this->model->allowField($data, 'ports');
        $this->model->fillable(array_keys($data));
        $this->model->fill($data);
        return $this->model->save();
    }


    public function edit($data)
    {
        $port = Port::find($data['port_id']);
        $data =  $port->allowField($data, 'ports');
        $port->fillable(array_keys($data));
        $port->fill($data);
        return $port->save();
    }
}