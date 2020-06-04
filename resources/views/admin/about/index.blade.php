@extends('admin.layouts.layout')
@section('css')
    <link href="{{loadEdition('/admin/css/upload/uploadPic.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row animated fadeInRight">
        <form onsubmit="return false;" id="form_about">
            {{csrf_field()}}
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>网站简介</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right">
                            <div id="preImg" class="about_background_preImg">
                                <img id="imghead" class="preview" alt="image" class="img-responsive" src="{{ $about->background }}" onclick="$('#previewImg').click();">
                            </div>
                            <input type="file" name="imgfile" onchange="previewImage_multiple(this, 'preImg', 'previewImg', 'imghead','imgStatus')" style="display: none;" id="previewImg">
                            <input type="hidden" name="background_imgStatus" id="imgStatus" value="1">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>简介标题</strong></h4>
                            <input type="text" class="form-control" name="title" value="{{ $about->title }}" required placeholder="请输入简介标题">

                            <h4><strong>关于我</strong></h4>
                            <div>
                                <textarea  style="width: 100%;" rows="8" name="introduction" placeholder="请输入我的简介">{{ $about->introduction }}</textarea>
                            </div>

                            <h4><strong>座右铭</strong></h4>
                            <div>
                                <textarea  style="width: 100%;" rows="2" name="motto" placeholder="请输入座右铭">{{ $about->motto }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>个人资料</h5>
                        <div class="ibox-tools" style="margin-top:-5px;">
                            <button type="button" class="btn btn-primary btn-sm" onclick="editAbout()" id="edit"><i class="fa fa-pencil"></i>&nbsp;编辑</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="complete" style="display: none;"><i class="fa fa-check"></i>&nbsp;完成</button>
                            <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>&nbsp;刷新</button>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="feed-activity-list">
                            <div class="feed-element">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">中文名：</label>
                                    <div class="input-group col-sm-10">
                                        <input type="text" class="form-control" name="chinese_name" value="{{ $about->chinese_name }}" required placeholder="请输入中文名">
                                    </div>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">英文名：</label>
                                    <div class="input-group col-sm-10">
                                        <input type="text" class="form-control" name="english_name" value="{{ $about->english_name }}" required placeholder="请输入英文名">
                                    </div>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">生日：</label>
                                    <div class="input-daterange input-group col-sm-10" id="datepicker">
                                        <input class="laydate-icon form-control layer-date" name="birthday" id="birthday" placeholder="YYYY-MM-DD" value="{{ $about->birthday }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">头像：</label>
                                    <div class="input-group col-sm-10 photos">
                                        <div id="preImg1" class="about_preImg">
                                            <img id="imghead1" class="preview" alt="image" class="img-responsive" src="{{ $about->pic }}" onclick="$('#previewImg1').click();">
                                        </div>
                                        <input type="file" name="imgfile" onchange="previewImage_multiple(this, 'preImg1', 'previewImg1', 'imghead1','imgStatus1')" style="display: none;" id="previewImg1">
                                        <input type="hidden" name="pic_imgStatus" id="imgStatus1" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">标签：</label>
                                    <div class="input-group col-sm-10">
                                        <input type="text" class="form-control" name="tags" value="{{ $about->tags }}" required placeholder="请输入人物标签">
                                    </div>
                                </div>
                            </div>

                            <div class="feed-element">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">微信：</label>
                                    <div class="input-group col-sm-10">
                                        <div class="input-group col-sm-10 photos">
                                            <div id="preImg2" class="about_preImg">
                                                <img id="imghead2" class="preview" alt="image" class="img-responsive" src="{{ $about->qr_code }}" onclick="$('#previewImg2').click();">
                                            </div>
                                            <input type="file" name="imgfile" onchange="previewImage_multiple(this, 'preImg2', 'previewImg2', 'imghead2','imgStatus2')" style="display: none;" id="previewImg2">
                                            <input type="hidden" name="qr_code_imgStatus" id="imgStatus2" value="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@section('js')

    {{--时间插件--}}
    <script src="{{URL::asset('js/plugins/layer/laydate/laydate.js')}}"></script>
    <script>
        var birthday={
            elem:"#birthday",
            format:"YYYY-MM-DD",
            min:laydate.now(),
            istime:false,
            // istoday:false,
            choose:function(datas){
                end.min=datas;
                end.start=datas
            }
        };
        laydate(birthday);
    </script>

    <script src="{{URL::asset('/admin/js/upload/uploadPic.js')}}"></script>

    <script>
        //初始化所有页面不可编辑
        $(function(){
            $("input").attr("disabled",true);
            $('textarea').attr('readonly', 'readonly');
        });

        //编辑处理
        function editAbout() {
            $("input").attr("disabled",false);
            $('textarea').removeAttr('readonly');
            $("#edit").hide();
            $("#complete").show();
        }

        $('#form_about').submit(function () {
            var index = layer.load(0, {//0代表加载的风格，支持0-2
                // shade: false,
                shade: 0.3,
                shadeClose: false, //是否开启遮罩关闭
            });

            var url = "{{route('about.editPost')}}";
            var title = "修改成功";
            var data = new FormData(this);//获取非文本类的数据
            var background_base64 = $("#imghead")[0].src;
            data.append('background_base64', background_base64);
            var pic_base64 = $("#imghead1")[0].src;
            data.append('pic_base64', pic_base64);
            var qr_code_base64 = $("#imghead2")[0].src;
            data.append('qr_code_base64', qr_code_base64);

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
                    if(data.code == 200){
                        swal({
                            title: title,
                            text: "页面将会自动跳转，请等待",
                            icon : "success",
                            showConfirmButton: false,
                            showCancelButton: false,
                            timer: 3000
                        }).then(
                            window.location.reload()
                        );
                    }else if(data.code == 10001){
                        layer.msg(data.msg);
                    }else{
                        swal({
                            title: "操作失败，请刷新重试!",
                            text: data.msg,
                            icon: "error",
                            timer: 3000
                        })
                    }
                },
                error : function (msg) {
                    layer.msg('服务器连接失败');
                    layer.close(index); // 关闭当前提示
                    return false;
                }
            });

        });
    </script>
@endsection