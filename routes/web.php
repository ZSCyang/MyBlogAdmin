<?php

/**
 * 后台路由
 */

/**后台模块**/
Route::group(['namespace' => 'Admin','prefix' => 'admin'], function (){

    Route::get('login','AdminsController@showLoginForm')->name('login');  //后台登陆页面

    Route::post('login-handle','AdminsController@loginHandle')->name('login-handle'); //后台登陆逻辑

    Route::get('logout','AdminsController@logout')->name('admin.logout'); //退出登录

    /**需要登录认证模块**/
    Route::middleware(['auth:admin','rbac'])->group(function (){

        Route::resource('index', 'IndexsController', ['only' => ['index']]);  //首页

        Route::get('index/main', 'IndexsController@main')->name('index.main'); //首页数据分析

        Route::get('admins/status/{statis}/{admin}','AdminsController@status')->name('admins.status');

        Route::get('admins/delete/{admin}','AdminsController@delete')->name('admins.delete'); //删除管理员

        Route::resource('admins','AdminsController',['only' => ['index', 'create', 'store', 'update', 'edit']]); //管理员

        Route::get('roles/access/{role}','RolesController@access')->name('roles.access');

        Route::post('roles/group-access/{role}','RolesController@groupAccess')->name('roles.group-access');

        Route::resource('roles','RolesController',['only'=>['index','create','store','update','edit','destroy'] ]);  //角色

        Route::get('roles/destroy/{role}','RolesController@destroy')->name('roles.destroy'); //删除角色

        Route::get('rules/status/{status}/{rules}','RulesController@status')->name('rules.status');

        Route::resource('rules','RulesController',['only'=> ['index','create','store','update','edit','destroy'] ]);  //权限

        Route::get('rules/destroy/{role}','RulesController@destroy')->name('rules.destroy'); //删除权限

        Route::resource('actions','ActionLogsController',['only'=> ['index','destroy'] ]);  //日志


        Route::get('admins/editAvatr','AdminsController@editAvatr') -> name('admins.editAvatr'); //修改头像
        Route::post('admins/post_changeAvatr','AdminsController@post_changeAvatr') -> name('admins.post_changeAvatr'); //提交修改头像

        Route::get('admins/changePsw','AdminsController@changePsw') -> name('admins.changePsw');//修改密码
        Route::post('admins/post_changePsw','AdminsController@post_changePsw') -> name('admins.post_changePsw');//提交修改密码

    });
});
