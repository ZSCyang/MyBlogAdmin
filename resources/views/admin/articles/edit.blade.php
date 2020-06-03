@extends('admin.layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/admin/css/markdown/editormd.css')}}" />
    <link href="{{loadEdition('/admin/css/upload/uploadPic.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-2">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="file-manager">
                        <form class="form-group form-inline" method="get" action="{{route('articles.index')}}">
                            <input type="text" value="{{$title}}" placeholder="请输入标题名称" name="title" class="form-control" style="width:190px;border-radius:40px;height: 28px;">
                            <i class="fa fa-search" style="font-size:initial"></i>
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
                <h5>杂文管理 > 编辑杂文 > <span class="current_nav">{{ $article->title }}</span></h5>
                <div class="ibox-tools" style="margin-top:-5px;">
                    <a class="menuid btn btn-primary btn-sm" href="javascript:history.go(-1)">返回</a>
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                </div>
            </div>
            <div class="ibox-content">
                <form onsubmit="return false;" id="form_articles">
                    {!! csrf_field() !!}
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标题：</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control col-sm-4" name="title" value="{{ $article->title }}" required data-msg-required="请输入网站名称">
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">简介：</label>
                                <div class="input-group col-sm-2">
                                    <textarea name="introduction" cols="51" rows="5" required>{{ $article->introduction }}</textarea>
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-inline">
                                <label class="col-sm-2 control-label">地点：</label>
                                <div class="form-group" style="margin:0">
                                    <div class="form-inline">
                                        <div id="distpicker4">
                                            <div class="form-group">
                                                <label class="sr-only" for="province9">Province</label>
                                                <select class="form-control" id="province9" name="province">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="city9">City</label>
                                                <select class="form-control" id="city9" name="city">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="district9">District</label>
                                                <select class="form-control" id="district9" name="township">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-t-sm m-b-sm">
                                <label class="col-sm-2 control-label"></label>
                                <div class="input-group col-sm-5">
                                    <input type="text" class="form-control col-sm-4" name="address" value="{{ $article->address }}" required placeholder="详细地址">
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control m-b" id="type" name="type" style="height: 32px;">
                                        @foreach($typeList as $type)
                                            <option value="{{$type->id}}" @if($type->id == $article->type)selected @endif>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">权限：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control m-b" id="power" name="power" style="height: 32px;">
                                        <option value="1" @if($article->power == 1)selected @endif>仅自己可见</option>
                                        <option value="2" @if($article->power == 2)selected @endif>对外开放</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">封面图：</label>
                                <div class="input-group col-sm-2">
                                    <div id="preImg" class="article_preImg">
                                        <img id="imghead" class="preview" src="{{ $article->pic }}" onclick="$('#previewImg').click();">
                                    </div>
                                    <input type="file" name="imgfile" onchange="previewImage(this)" style="display: none;" id="previewImg">
                                    <input type="hidden" name="imgStatus" id="imgStatus" value="1">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12">
                        <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">杂文内容：</label>
                            <div id="myeditormd" style="z-index: 99999;">
                                <!-- Tips: Editor.md can auto append a `<textarea>` tag -->
                                <textarea style="display:none;" name="test-editormd">{{ $article->content }}</textarea>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="article_id" id="article_id" value="{{ $article->id }}" />
                    <div class="col-sm-12">
                        <div style="margin:0 auto;text-align:center;">
                            {{--<button class="btn btn-primary" type="submit" id="btn-submit"><i class="fa fa-check"></i>&nbsp;草稿</button>--}}
                            {{--<a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="存为草稿"><i class="fa fa-pencil"></i> 存为草稿</a>--}}
                            <input type="submit" class="btn btn-white" name="draft" value="存为草稿" />
                            <input type="submit" class="btn btn-primary" name="publish" value="立即发布" />
                            {{--<button class="btn btn-primary" type="submit" id="btn-submit"><i class="fa fa-check"></i>&nbsp;发布</button>--}}
                            <button class="btn btn-primary" type="reset" onclick="javascript:history.back(-1);"><i class="fa fa-repeat"></i> 返回列表</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('/admin/js/markdown/editormd.min.js')}}"></script>
    <script type="text/javascript">
        var testEditor;
        $(function () {
            testEditor = editormd("myeditormd",{
                width:"100%",
                height:600,
                syncScrolling:"single",
                taskList : true,
                tocm: true,
                path:"{{URL::asset('/admin/js/markdown/lib/')}}" + "/",
                tex:true,
                flowChart       : true,
                sequenceDiagram:true,
                saveHTMLToTextarea : true,
                imageUpload : true,
                imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL : "{{ route('markdown.uploadFile')}}",
            });
        });
    </script>
    <script>

        var submitActor = null;
        var $submitActors = $("#form_articles").find('input[type=submit]');

        //编辑网站基础信息
        $('#form_articles').submit(function () {

            if (null === submitActor) {
                submitActor = $submitActors[0];
            }

            var data = new FormData(this);//获取非文本类的数据
            if (submitActor.name == "publish") {
                data.append('status', 1);
            } else {
                data.append('status', 2);
            }

            //封面图
            var base64Img = $("#imghead")[0].src;
            data.append('base64Img', base64Img);

            $("#btn-submit").attr("disabled", "disabled");
            var index = layer.load(0, {//0代表加载的风格，支持0-2
                // shade: false,
                shade: 0.3,
                shadeClose: false, //是否开启遮罩关闭
            });

            var url = "{{route('articles.editPost')}}";
            var title = "修改成功";
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
                            title : "修改成功",
                            text : "请选择接下来的操作？",
                            icon : "success",
                            buttons : {
                                button1 : {
                                    text : "回到列表页",
                                    value : true,
                                },
                                button2 : {
                                    text : "继续编辑",
                                    value : false,
                                }
                            },

                        }).then(function(value) {   //这里的value就是按钮的value值，只要对应就可以啦
                            if (value) {
                                window.history.back(-1);
                                //window.location.href = "window.location.go(-1); "
                            } else {
                                window.location.reload();
                            }
                        });

                    } else if(data.code == 10001) {
                        layer.msg(data.msg);
                    } else {
                        swal({
                            title: "操作失败，请刷新重试!",
                            text: data.msg,
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


    <script src="{{URL::asset('/admin/js/distpicker/distpicker.data.js')}}"></script>
    <script src="{{URL::asset('/admin/js/distpicker/distpicker.js')}}"></script>
    <script src="{{URL::asset('/admin/js/distpicker/main.js')}}"></script>

    <script>
        $("#distpicker4").distpicker({
            province: "{{ $article->province }}",
            city: "{{ $article->city }}",
            district: "{{ $article->township }}",
            autoSelect: true,
            placeholder: false
        });
    </script>

    <script src="{{URL::asset('/admin/js/upload/uploadPic.js')}}"></script>

@endsection
