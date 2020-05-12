<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/11/17
 * Time: 下午4:40
 */

namespace App\Repositories\V1;

use App\Models\Wisdom;

class WisdomsRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Wisdom();
    }


    /**
     * 添加智慧语录
     * Author jintao.yang
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $data =  $this->model->allowField($data, 'wisdoms');
        $this->model->fillable(array_keys($data));
        $this->model->fill($data);
        return $this->model->save();
    }


    /**
     * 编辑智慧语
     * Author jintao.yang
     * @param $data
     * @return mixed
     */
    public function edit($data)
    {
        $wisdomModel = Wisdom::find($data['wisdom_id']);
        $data =  $this->model->allowField($data, 'wisdoms');
        $wisdomModel->fillable(array_keys($data));
        $wisdomModel->fill($data);
        return $wisdomModel->save();
    }

    /**
     * 删除智慧语
     * Author jintao.yang
     * @param $wisdomId
     * @return mixed
     */
    public function delete($wisdomId)
    {
        $wisdomModel = Wisdom::find($wisdomId);
        return $wisdomModel->delete();
    }
}