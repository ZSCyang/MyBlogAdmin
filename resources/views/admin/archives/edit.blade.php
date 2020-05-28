@extends('admin.layouts.layout')
@section('css')

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
        <div class="col-sm-10">
            <div class="ibox-title">
                <h5>博文管理 > 编辑博文 > <span class="current_nav">{{ $archive->title }}</span></h5>
                <div class="ibox-tools" style="margin-top:-5px;">
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                </div>
            </div>
            <div class="ibox-content">
                <form onsubmit="return false;" id="form_archives">
                    {!! csrf_field() !!}
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标题：</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control col-sm-4" name="title" value="{{ $archive->title }}" required data-msg-required="请输入网站名称">
                                </div>
                            </div>
                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">简介：</label>
                                <div class="input-group col-sm-2">
                                    <textarea name="introduction" cols="51" rows="5" required>{{ $archive->introduction }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型：</label>
                                <div class="input-group col-sm-2">
                                    <select class="form-control m-b" id="type" name="type" style="height: 32px;">
                                        <option value="1">php</option>
                                        <option value="2">mysql</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">权限：</label>
                                <div class="input-group col-sm-2">
                                    <select class="form-control m-b" id="power" name="power" style="height: 32px;">
                                        <option value="1">仅自己可见</option>
                                        <option value="2" selected>对外开放</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">博文内容：</label>
                            <div id="test-editormd" style="z-index: 99999;">
                                <textarea name="test-editormd" style="display:none;">{{ $archive->content }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div style="margin:0 auto;text-align:center;">
                            {{--<button class="btn btn-primary" type="submit" id="btn-submit"><i class="fa fa-check"></i>&nbsp;草稿</button>--}}
                            {{--<a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="存为草稿"><i class="fa fa-pencil"></i> 存为草稿</a>--}}
                            <button class="btn btn-primary" type="submit" id="btn-submit"><i class="fa fa-check"></i>&nbsp;发布</button>
                            <button class="btn btn-white" type="reset" ><i class="fa fa-repeat"></i> 重 置</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    @include('markdown::encode',['editors'=>['test-editormd']])
@endsection

@section('js')

    <script>
        //编辑网站基础信息
        $('#form_archives').submit(function () {
            $("#btn-submit").attr("disabled", "disabled");
            var index = layer.load(0, {//0代表加载的风格，支持0-2
                // shade: false,
                shade: 0.3,
                shadeClose: false, //是否开启遮罩关闭
            });

            var url = "{{route('archives.addPost')}}";
            var title = "添加成功";
            var data = new FormData(this);//获取非文本类的数据
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: 'post',
                data: data,
                url : url,
                processData:false,
                contentType:false,
                success : function(data) {
                    layer.close(index); // 关闭当前加载提示
                    $("#btn-submit").removeAttr("disabled");//释放按钮
                    if(data.code == 200){

                        swal({
                            title : "提交成功",
                            text : "请选择接下来的操作？",
                            icon : "success",
                            buttons : {
                                button1 : {
                                    text : "回到列表页",
                                    value : true,
                                },
                                button2 : {
                                    text : "继续添加",
                                    value : false,
                                }
                            },

                        }).then(function(value) {   //这里的value就是按钮的value值，只要对应就可以啦
                            if (value) {
                                window.location.href = "/"
                            } else {
                                window.location.reload();
                            }
                        });


                    }else {
                        swal({
                            title: "操作失败，请刷新重试!",
                            text: data.message,
                            showConfirmButton: false,
                            type: "error",
                            showCancelButton: false,
                            timer: 2000
                        })
                    }
                },
                error : function (msg) {
                    layer.msg('服务器连接失败');
                    layer.close(index); // 关闭当前提示
                    $("#btn-submit").removeAttr("disabled");//释放按钮
                    return false;
                }
            });

        });

    </script>

@endsection
