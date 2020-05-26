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


        .div_footer {
            width: 90%;
            position: absolute;
            bottom: 0;
            height: 50px;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-2">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <form class="form-group form-inline" method="get" action="{{route('archives.index')}}">
                            <input type="text" value="{{$title}}" placeholder="请输入标题名称" name="title" class="form-control" style="width:190px;border-radius:40px;height: 28px;">
                            <i class="fa fa-search" style="font-size:initial"></i>
                        </form>
                        <h5>显示：<a href="{{route('archives.index')}}" class="file-control active">所有</a></h5>

                        <div class="hr-line-dashed"></div>
                        <h5>文件夹</h5>
                        <ul class="folder-list" style="padding: 0">
                            @foreach($typeList as $type)
                            <li>
                            @if($type->id == $typeId)
                                <div style="z-index:0;background: #eae9e9;">
                            @else
                                 <div>
                            @endif
                                     <a href="{{route('archives.index', ['type'=> $type->id])}}">
                                          <i class="fa fa-folder"></i> {{ $type->name }}
                                          <span class="label label-danger pull-right">2</span>
                                     </a>
                                 </div>
                            </li>
                            @endforeach
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
        <div class="col-lg-10 animated fadeInRight">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="pull-left">
                        <button class="btn btn-white btn-sm" onclick="javascript:history.back(-1);"><i class="fa fa-arrow-left"></i></button>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-white btn-xs" type="button"><i class="fa fa-eye"> </i>&nbsp;7110</button>
                        <button class="btn btn-white btn-xs" type="button"><i class="fa fa-comments-o"> </i>&nbsp;0</button>
                        <button class="btn btn-white btn-xs" type="button">php</button>
                        <button class="btn btn-white btn-xs" type="button">环境部署</button>
                    </div>
                    <div class="text-center article-title">
                        <h1>
                            {{$archive->title}}
                        </h1>
                    </div>

                    <p>
                        兜兜转转之后，这场“瘟疫”又找上了在生活中不那么起眼的自行车。然而，在搭上智能化的顺风车之前，你可知道自行车的历史？虽然，在乐视超级自行车的发布会上，它已经用了自行车史上有着重要地位的三个名字——斯塔利、西夫拉克、阿尔普迪埃——来命名自家的自行车，但那远远不够。Gizmodo 为我们梳理了自行车发展的关键节点。
                    </p>
                    <p>
                        在开始之前，我们先来看看丹麦的设计师制作的动画，一分钟看完自行车近 200 年的演变。
                    </p>

                    <div class="row">
                        <div class="col-lg-12">

                            <h2>评论：</h2>
                            <div class="social-feed-box">
                                <div class="social-avatar">
                                    <a href="#" class="pull-left">
                                        <img alt="image" src="img/a1.jpg">
                                    </a>
                                    <div class="media-body">
                                        <a href="#">
                                            逆光狂胜蔡舞娘
                                        </a>
                                        <small class="text-muted">17 小时前</small>
                                    </div>
                                </div>
                                <div class="social-body">
                                    <p>
                                        好东西，我朝淘宝准备跟进，1折开卖
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection



