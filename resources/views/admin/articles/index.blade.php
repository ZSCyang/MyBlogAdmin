@extends('admin.layouts.layout')
@section('css')
    <style>
        .file-name1{
            color: #393939;
            line-height: 23px;
        }

        .note-abstract {
            color: #82828c;
            line-height: 23px;
            margin: 6px 0 0;
            height: 75px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            position: relative;
        }

        .file-box{
            width: 22%;
            height: 183px;
            background-color: rgb(255, 255, 255);
            position: relative;
            margin-bottom: 40px;
            margin-right: 20px;
            border-width: 1px;
            border-style: solid;
            border-color: rgb(231, 234, 236);
            border-image: initial;
            padding: 0px;
        }


        .title_name{

            line-height: 20px;
            margin: 6px 0 0;
            height: 20px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            margin-bottom:16px;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-2">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <form class="form-group form-inline" >
                            <input type="text" value="" placeholder="请输入校长名称" name="headmaster" class="form-control" style="width:190px;border-radius:40px;height: 28px;">
                            <i class="fa fa-search" style="font-size:initial"></i>
                        </form>
                        <h5>显示：<a href="#" class="file-control active">所有</a></h5>

                        <div class="hr-line-dashed"></div>
                        <h5>文件夹</h5>
                        <ul class="folder-list" style="padding: 0">
                            <li>
                                <a href="file_manager.html">
                                    <i class="fa fa-folder"></i> Mysql
                                    <span class="label label-danger pull-right">2</span>
                                </a>
                            </li>
                            <li><a href="file_manager.html"><i class="fa fa-folder"></i> PHP</a>
                            </li>
                            <li><a href="file_manager.html"><i class="fa fa-folder"></i> Linux</a>
                            </li>
                        </ul>
                        <h5 class="tag-title">标签</h5>
                        <ul class="tag-list" style="padding: 0">
                            <li><a href="file_manager.html">爱人</a>
                            </li>
                            <li><a href="file_manager.html">工作</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10 animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="file-box">
                        <div class="ibox-content">

                            <div class="title_name">
                                <a href="article.html" class="btn-link">
                                    <span class="file-name1">Nginx支持PHP,有时候这里是两Nginx支持PHP,有时候这里是两</span>
                                </a>
                            </div>

                            <div class="small m-b-xs">
                                <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> 2020-05-13</span>
                            </div>

                            <div class="note-abstract">
                                <span>就算你敢带着 Apple Watch 下水游泳，它也不能记录你游了多少圈。 夏天刚来时就不停地听到有人提起“有没有在我游泳的时候可以帮忙数圈的时候可以帮忙数圈</span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-xs" type="button">详情</button>
                                    <button class="btn btn-white btn-xs" type="button">编辑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="ibox-content">

                            <div class="title_name">
                                <a href="article.html" class="btn-link">
                                    <span class="file-name1">Nginx支持PHP</span>
                                </a>
                            </div>

                            <div class="small m-b-xs">
                                <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> 2020-05-13</span>
                            </div>

                            <div class="note-abstract">
                                <span>就算你敢带着 Apple Watch 下水游泳，它也不能记录你游了多少圈。 夏天刚来时就不停地听到有人提起“有没有在我游泳的时候可以帮忙数圈的时候可以帮忙数圈</span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-xs" type="button">详情</button>
                                    <button class="btn btn-white btn-xs" type="button">编辑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="ibox-content">

                            <div class="title_name">
                                <a href="article.html" class="btn-link">
                                    <span class="file-name1">Nginx支持PHP,有时候这里是两Nginx支持PHP,有时候这里是两</span>
                                </a>
                            </div>

                            <div class="small m-b-xs">
                                <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> 2020-05-13</span>
                            </div>

                            <div class="note-abstract">
                                <span>就算你敢带着 Apple Watch 下水游泳，它也不能记录你游了多少圈。 夏天刚来时就不停地听到有人提起“有没有在我游泳的时候可以帮忙数圈的时候可以帮忙数圈</span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-xs" type="button">详情</button>
                                    <button class="btn btn-white btn-xs" type="button">编辑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="ibox-content">

                            <div class="title_name">
                                <a href="article.html" class="btn-link">
                                    <span class="file-name1">PHP+Redis 自动关闭订单或者自动完成订单</span>
                                </a>
                            </div>

                            <div class="small m-b-xs">
                                <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> 2020-05-13</span>
                            </div>

                            <div class="note-abstract">
                                <span>就算你敢带着 Apple Watch 下水游泳，它也不能记录你游了多少圈。 </span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-xs" type="button">详情</button>
                                    <button class="btn btn-white btn-xs" type="button">编辑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="ibox-content">

                            <div class="title_name">
                                <a href="article.html" class="btn-link">
                                    <span class="file-name1">Nginx支持PHP</span>
                                </a>
                            </div>

                            <div class="small m-b-xs">
                                <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> 2020-05-13</span>
                            </div>

                            <div class="note-abstract">
                                <span>就算你敢带着 Apple Watch 下水游泳，它也不能记录你游了多少圈。 夏天刚来时就不停地听到有人提起“有没有在我游泳的时候可以帮忙数圈的时候可以帮忙数圈</span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-xs" type="button">详情</button>
                                    <button class="btn btn-white btn-xs" type="button">编辑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="ibox-content">

                            <div class="title_name">
                                <a href="article.html" class="btn-link">
                                    <span class="file-name1">Nginx支持PHP</span>
                                </a>
                            </div>

                            <div class="small m-b-xs">
                                <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> 2020-05-13</span>
                            </div>

                            <div class="note-abstract">
                                <span>就算你敢带着 Apple Watch 下水游泳</span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-xs" type="button">详情</button>
                                    <button class="btn btn-white btn-xs" type="button">编辑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="ibox-content">

                            <div class="title_name">
                                <a href="article.html" class="btn-link">
                                    <span class="file-name1">Nginx支持PHP,有时候这里是两Nginx支持PHP,有时候这里是两</span>
                                </a>
                            </div>

                            <div class="small m-b-xs">
                                <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> 2020-05-13</span>
                            </div>

                            <div class="note-abstract">
                                <span>就算你敢带着 Apple Watch 下水游泳，它也不能记录你游了多少圈。 夏天刚来时就不停地听到有人提起“有没有在我游泳的时候可以帮忙数圈的时候可以帮忙数圈</span>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-xs" type="button">详情</button>
                                    <button class="btn btn-white btn-xs" type="button">编辑</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

