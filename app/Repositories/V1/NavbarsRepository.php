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

use App\Models\Navbar;

class NavbarsRepository
{
    /**
     * 获取导航栏列表
     * Author jintao.yang
     * @return mixed
     */
    public function getNavbars()
    {
        return Navbar::paginate(10);
    }


    public function add($data)
    {
        return Navbar::save($data);
    }

}