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
                        <form class="form-group form-inline" method="get" action="{{route('articles.index')}}">
                            <input type="text" value="{{$title}}" placeholder="请输入标题名称" name="title" class="form-control" style="width:100%;border-radius:40px;height: 28px;">
                            {{--<i class="fa fa-search" style="font-size:initial"></i>--}}
                        </form>
                        <h5>显示：<a href="{{route('articles.index')}}" class="file-control active">所有</a></h5>

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
                                        <a href="{{route('articles.index', ['type'=> $type->id])}}">
                                            <i class="fa fa-folder"></i> {{ $type->name }}
                                            <span class="label label-danger pull-right">2</span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <h5 class="tag-title">标签</h5>
                        <ul class="tag-list" style="padding: 0">
                            <li>
                                <a href="{{route('articles.index', ['type'=> $typeId, 'status'=>1 ])}}" @if($status == 1) style="color: red;" @endif>已发布</a>
                            </li>
                            <li>
                                <a href="{{route('articles.index', ['type'=> $typeId, 'status'=>2])}}" @if($status == 2) style="color: red;" @endif>草稿</a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10 animated fadeInRight">
            <div class="row" style="height: 750px;">
                <div class="col-sm-12">
                    @if(count($articlesList) > 0)
                        @foreach($articlesList as $archive)
                            <div class="file-box">
                                <div class="ibox-content">

                                    <div class="title_name">
                                        <a href="{{route('articles.detail',['id'=>$archive->id, 'type'=>$typeId, 'title'=>$title])}}" class="btn-link">
                                            <span class="file-name1">{{ $archive->title }}</span>
                                        </a>
                                    </div>

                                    <div class="small m-b-xs">
                                        <span><img src="{{URL::asset('/images/logo/php.png')}}" style="width: 20px;"/> </span> <span class="text-muted"><i class="fa fa-clock-o"></i> {{ $archive->created_at }}</span>
                                    </div>

                                    <div class="note-abstract">
                                        <span>{{ $archive->introduction }}</span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-primary btn-xs" href="{{route('articles.detail',['id'=>$archive->id, 'type'=>$typeId, 'title'=>$title, 'status'=> $status])}}">详情</a>
                                            <a class="btn btn-white btn-xs J_menuItem"  data-index="index_v1.html" href="{{route('articles.edit',['id'=>$archive->id, 'type'=>$typeId, 'title'=>$title, 'status'=> $status])}}">编辑</a>
                                            <div class="stat-percent" style="padding-top:3px;">
                                                <span style="font-size: 12px;color: rgba(96,104,101,0.57);margin-top: 20px;">发布中</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="text-align: center;">
                            <span style="color: red;">没有搜索到您想要的东西哦~~~</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="div_footer" style="text-align: center;position:fixed; bottom:0;">
                {{ $articlesList->appends(['type'=>$typeId, 'status'=>$status])->links() }}
            </div>
        </div>
    </div>

@endsection

