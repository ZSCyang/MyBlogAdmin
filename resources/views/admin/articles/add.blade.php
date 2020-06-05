@extends('admin.layouts.layout')
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/admin/css/markdown/editormd.css')}}" />
    <link href="{{loadEdition('/admin/css/upload/uploadPic.css')}}" rel="stylesheet">
@endsection
@section('content')
    <meta name="_token" content="{{ csrf_token() }}"/>
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>杂文管理 > <span class="current_nav">添加杂文</span></h5>
                <div class="ibox-tools" style="margin-top:-5px;">
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                </div>
            </div>
            <div class="ibox-content">
                <form onsubmit="return false;" id="form_articles">
                    {!! csrf_field() !!}
                    <div class="col-sm-12">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标题：</label>
                                <div class="input-group col-sm-6">
                                    <input type="text" class="form-control col-sm-4" name="title" value="" required placeholder="请输入网站名称">
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">简介：</label>
                                <div class="input-group col-sm-2">
                                    <textarea name="introduction" cols="51" rows="5" required placeholder="文章简介"></textarea>
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
                                                <select class="form-control" id="province9" name="province"></select>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="city9">City</label>
                                                <select class="form-control" id="city9" name="city"></select>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="district9">District</label>
                                                <select class="form-control" id="district9" name="township"></select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-t-sm m-b-sm">
                                <label class="col-sm-2 control-label"></label>
                                <div class="input-group col-sm-5">
                                    <input type="text" class="form-control col-sm-4" name="address" value="" required placeholder="详细地址">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">类型：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control m-b" id="type" name="type" style="height: 32px;">
                                        @foreach($typeList as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">权限：</label>
                                <div class="input-group col-sm-4">
                                    <select class="form-control m-b" id="power" name="power" style="height: 32px;">
                                        <option value="1">仅自己可见</option>
                                        <option value="2" selected>对外开放</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">封面图：</label>
                                <div class="input-group col-sm-2">
                                    <div id="preImg" class="article_preImg">
                                        <img id="imghead" class="preview" src="{{URL::asset('/images/photo_icon.png')}}" onclick="$('#previewImg').click();">
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
                            <label class="col-sm-2 control-label">博文内容：</label>
                            <div id="myeditormd" style="z-index: 99999;">
                                <!-- Tips: Editor.md can auto append a `<textarea>` tag -->
                                <textarea style="display:none;" name="test-editormd"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div style="margin:0 auto;text-align:center;">
                            <input type="submit" class="btn btn-white" name="draft" value="存为草稿" />
                            <input type="submit" class="btn btn-primary" name="publish" value="立即发布" />
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
        $('#form_articles').submit(function (event) {
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

            var url = "{{route('articles.addPost')}}";
            var title = "添加成功";

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

                        swal.fire({
                            title : "提交成功",
                            text : "请选择接下来的操作？",
                            icon : "success",
                            showCancelButton: false,
                            confirmButtonText: '继续添加'

                        }).then(function(value) {   //这里的value就是按钮的value值，只要对应就可以啦{
                            setTimeout(function() {
                                window.location.reload();
                            },2000)
                        });


                    } else if(data.code == 10001) {
                        layer.msg(data.msg);
                    } else {
                        swal.fire({
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

        $submitActors.click(function(event) {
            submitActor = this;
        });


        function paste(event) {

            var clipboardData = event.clipboardData;
            var items, item, types;
            if (clipboardData) {
                items = clipboardData.items;
                if (!items) {
                    return;
                }
                // 保存在剪贴板中的数据类型
                types = clipboardData.types || [];
                for (var i = 0; i < types.length; i++) {
                    if (types[i] === 'Files') {
                        item = items[i];
                        break;
                    }
                }
                // 判断是否为图片数据
                if (item && item.kind === 'file' && item.type.match(/^image\//i)) {
                    // 读取该图片
                    var file = item.getAsFile(),
                        reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        //前端压缩
                        $.ajax({
                            url: "{{route('markdown.uploadBase64')}}",
                            type: 'post',
                            data: {
                                "image_base64": reader.result,
                                '_token':'{{csrf_token()}}'
                            },
                            contentType: 'application/x-www-form-urlencoded;charest=UTF-8',
                            success: function (data) {
                                if(data.code == 200){
                                    var qiniuUrl = '![](' + data.data + ')';
                                    testEditor.insertValue(qiniuUrl);
                                }else{
                                    alert("上传失败");
                                }

                            }
                        })
                    }
                }
            }
        }
        document.addEventListener('paste', function (event) {
            paste(event);
        })
    </script>

    <script src="{{URL::asset('/admin/js/distpicker/distpicker.data.js')}}"></script>
    <script src="{{URL::asset('/admin/js/distpicker/distpicker.js')}}"></script>
    <script src="{{URL::asset('/admin/js/distpicker/main.js')}}"></script>

    <script src="{{URL::asset('/admin/js/upload/uploadPic.js')}}"></script>

@endsection
