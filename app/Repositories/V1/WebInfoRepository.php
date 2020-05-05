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

use App\Models\WebInfo;

class WebInfoRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new WebInfo();
    }

    public function getWebInfo()
    {
        return $this->model->first();
    }

    public function edit($data)
    {
        $webInfoModel = WebInfo::find($data['webInfo_id']);
        $data =  $this->model->allowField($data, 'web_info');
        $webInfoModel->fillable(array_keys($data));
        $webInfoModel->fill($data);
        return $webInfoModel->save();
    }
}