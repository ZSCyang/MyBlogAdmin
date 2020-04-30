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

use App\Models\Cover;

class CoversRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new Cover();
    }

    /**
     * 添加封面图
     * Author jintao.yang
     * @param $data
     * @return bool
     */
    public function add($data)
    {
        $data =  $this->model->allowField($data, 'covers');
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
        $coverModel = Cover::find($data['cover_id']);
        $data =  $this->model->allowField($data, 'covers');
        $coverModel->fillable(array_keys($data));
        $coverModel->fill($data);
        return $coverModel->save();
    }


    /**
     * 删除封面图
     * Author jintao.yang
     * @param $coverId
     * @return mixed
     */
    public function delete($coverId)
    {
        $coverModel = Cover::find($coverId);
        return $coverModel->delete();
    }

}