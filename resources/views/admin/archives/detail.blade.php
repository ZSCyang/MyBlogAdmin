@extends('admin.layouts.layout')
@section('css')
<style>

    .editormd-html-preview ol.linenums li code,.editormd-preview-container ol.linenums li code{
        /*border:none;background:0 0;padding:0;white-space: nowrap*/
        word-break: break-all;
        white-space: pre;
        overflow-x: scroll;
        overscroll-behavior-x: contain;
    }
    .editormd-preview-container pre.prettyprint, .editormd-html-preview pre.prettyprint{
        word-break: break-all;
        white-space: pre;
        overflow-x: scroll;
        overscroll-behavior-x: contain;
    }
    .editormd-html-preview ol.linenums,.editormd-preview-container ol.linenums{min-width: 100%;color:#999;padding-left:2.5em;display: inline-block}

</style>
<link rel="stylesheet" href="{{URL::asset('/admin/css/markdown/editormd.css')}}" />
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
                            {{ $archive->title }}
                        </h1>
                    </div>

                    <div id="show_editor">
                        <textarea style="display: none">{{$archive->content}}</textarea>
                    </div>

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

@section('js')
    <script type="text/javascript">
        $(function() {
            var testEditormdView;
            testEditormdView = editormd.markdownToHTML("show_editor", {
                htmlDecode      : "style,script,iframe",  // you can filter tags decode
                emoji           : true,
                taskList        : true,
                tex             : true,  // 默认不解析
                flowChart       : true,  // 默认不解析
                sequenceDiagram : true,  // 默认不解析
            });
        });
    </script>
    <script src="{{URL::asset('/admin/js/markdown/editormd.min.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('/admin/js/markdown/lib/marked.min.js')}}"></script>
    <script src="{{URL::asset('/admin/js/markdown/lib/prettify.min.js')}}"></script>
    <script src="{{URL::asset('/admin/js/markdown/lib/raphael.min.js')}}"></script>
    <script src="{{URL::asset('/admin/js/markdown/lib/underscore.min.js')}}"></script>
    <script src="{{URL::asset('/admin/js/markdown/lib/sequence-diagram.min.js')}}"></script>
    <script src="{{URL::asset('/admin/js/markdown/lib/flowchart.min.js')}}"></script>
    <script src="{{URL::asset('/admin/js/markdown/lib/jquery.flowchart.min.js')}}"></script>
@endsection


