<?php

/**
 * 后台路由
 */

/**后台模块**/
Route::group(['namespace' => 'Admin','prefix' => 'admin'], function () {

    Route::get('login', 'AdminsController@showLoginForm')->name('login');  //后台登陆页面

    Route::post('login-handle', 'AdminsController@loginHandle')->name('login-handle'); //后台登陆逻辑

    Route::get('logout', 'AdminsController@logout')->name('admin.logout'); //退出登录

    /**需要登录认证模块**/
    Route::middleware(['auth:admin','rbac'])->group(function () {

        Route::resource('index', 'IndexsController', ['only' => ['index']]);  //首页

        Route::get('index/main', 'IndexsController@main')->name('index.main'); //首页数据分析

        Route::get('admins/status/{statis}/{admin}', 'AdminsController@status')->name('admins.status');

        Route::get('admins/delete/{admin}', 'AdminsController@delete')->name('admins.delete'); //删除管理员

        Route::resource('admins', 'AdminsController', ['only' => ['index','create','store','update','edit']]); //管理员

        Route::get('roles/access/{role}', 'RolesController@access')->name('roles.access');

        Route::post('roles/group-access/{role}', 'RolesController@groupAccess')->name('roles.group-access');

        Route::resource('roles', 'RolesController', ['only'=>['index','create','store','update','edit','destroy']]);  //角色

        Route::get('roles/destroy/{role}', 'RolesController@destroy')->name('roles.destroy'); //删除角色

        Route::get('rules/status/{status}/{rules}', 'RulesController@status')->name('rules.status');

        Route::resource('rules', 'RulesController', ['only' => ['index','create','store','update','edit','destroy']]);  //权限

        Route::get('rules/destroy/{role}', 'RulesController@destroy')->name('rules.destroy'); //删除权限

        Route::resource('actions', 'ActionLogsController', ['only'=> ['index','destroy']]);  //日志


        Route::get('admins/editAvatr', 'AdminsController@editAvatr')->name('admins.editAvatr'); //修改头像


        Route::post('admins/post_changeAvatr', 'AdminsController@post_changeAvatr')
            ->name('admins.post_changeAvatr'); //提交修改头像

        Route::get('admins/changePsw', 'AdminsController@changePsw')->name('admins.changePsw'); //修改密码
        Route::post('admins/post_changePsw', 'AdminsController@post_changePsw')->name('admins.post_changePsw');//提交修改密码


        //网站设置模块
        Route::group(['prefix' => 'webSetting'], function () {

            //导航栏管理
            Route::group(['prefix' => 'navBars'], function () {
                Route::get('index', 'WebSetting\NavBarsController@index')->name('webSetting.navBars.index');
                Route::post('addPost', 'WebSetting\NavBarsController@addPost')->name('webSetting.navBars.addPost');
                Route::put('editPost', 'WebSetting\NavBarsController@editPost')->name('webSetting.navBars.editPost');
                Route::get('deletePost', 'WebSetting\NavBarsController@deletePost')->name('webSetting.navBars.deletePost');
            });

            //封面图管理
            Route::group(['prefix' => 'covers'], function () {
                Route::get('index', 'WebSetting\CoversController@index')->name('webSetting.covers.index');
                Route::post('addPost', 'WebSetting\CoversController@addPost')->name('webSetting.covers.addPost');
                Route::any('editPost', 'WebSetting\CoversController@editPost')->name('webSetting.covers.editPost');
                Route::get('deletePost', 'WebSetting\CoversController@deletePost')->name('webSetting.covers.deletePost');
            });

            //网站基本信息
            Route::group(['prefix' => 'webInfo'], function () {
                Route::get('index', 'WebSetting\WebInfoController@index')->name('webSetting.webInfo.index');
                Route::any('editPost', 'WebSetting\WebInfoController@editPost')->name('webSetting.webInfo.editPost');
            });
        });



        //杂文模块
        Route::group(['prefix' => 'articles'], function () {

            //智慧语管理
            Route::group(['prefix' => 'wisdoms'], function () {
                Route::get('index', 'Articles\WisdomsController@index')->name('articles.wisdoms.index');
                Route::post('addPost', 'Articles\WisdomsController@addPost')->name('articles.wisdoms.addPost');
                Route::post('editPost', 'Articles\WisdomsController@editPost')->name('articles.wisdoms.editPost');
                Route::get('deletePost', 'Articles\WisdomsController@deletePost')->name('articles.wisdoms.deletePost');
            });

            Route::get('index', 'Articles\ArticlesController@index')->name('articles.index');
        });


        //博文模块
        Route::group(['prefix' => 'archives'], function () {
            Route::get('index', 'Archives\ArchivesController@index')->name('archives.index');
            Route::get('add', 'Archives\ArchivesController@add')->name('archives.add');
            Route::post('addPost', 'Archives\ArchivesController@addPost')->name('archives.addPost');
            Route::get('detail/{archive}', 'Archives\ArchivesController@detail')->name('archives.detail');
            Route::get('edit/{archive}', 'Archives\ArchivesController@edit')->name('archives.edit');
            Route::post('editPost', 'Archives\ArchivesController@editPost')->name('archives.editPost');
        });

        //我的信息模块
        Route::group(['prefix' => 'about'], function () {
            Route::get('index', 'About\AboutController@index')->name('about.index');
        });

        //字典管理
        Route::group(['prefix' => 'dictionaries'], function () {

            Route::get('articlesTypeList', 'DictionariesController@articlesTypeList')
                ->name('dictionaries.articlesTypeList');

            Route::get('archivesTypeList', 'DictionariesController@archivesTypeList')
                ->name('dictionaries.archivesTypeList');

            Route::post('addPost', 'DictionariesController@addPost')
                ->name('dictionaries.addPost');
            Route::post('editPost', 'DictionariesController@editPost')
                ->name('dictionaries.editPost');

            Route::get('deletePost', 'DictionariesController@deletePost')
                ->name('dictionaries.deletePost');
        });
    });
});

//公共模块
Route::post('markdown/upload', function () {
    return 123;
    $info = Controller::uploadFile();
    return json_encode($info);
})->name('markdown.uploadFile');
