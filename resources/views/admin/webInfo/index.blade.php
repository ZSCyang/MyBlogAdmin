@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>网站设置 > <span class="current_nav">基础信息管理</span></h5>
                <div class="ibox-tools" style="margin-top:-5px;">
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                </div>
            </div>
            <div class="ibox-content">
                <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                <form onsubmit="return false;" id="form_webinfo">
                    {!! csrf_field() !!}
                    {{method_field('PATCH')}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">网站名称：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="web_name" value="{{$webInfo->web_name}}" required data-msg-required="请输入网站名称">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">底部内容：</label>
                        <div class="input-group col-sm-2">
                            <input type="text" class="form-control" name="bottom" value="{{$webInfo->bottom}}" required data-msg-required="请输入底部内容">
                        </div>
                    </div>
                    <div class="hr-line-dashed m-t-sm m-b-sm"></div>
                    <div class="form-group">
                        <div class="col-sm-12 col-sm-offset-2">
                            <input type="hidden" name="webInfo_id" value="{{$webInfo->id}}">
                            <button class="btn btn-primary" type="submit" id="btn-submit"><i class="fa fa-check"></i>&nbsp;保 存</button>
                            <button class="btn btn-white" type="reset" ><i class="fa fa-repeat"></i> 重 置</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        //编辑网站基础信息
        $('#form_webinfo').submit(function () {
            $("#btn-submit").attr("disabled", "disabled");
            var index = layer.load(0, {//0代表加载的风格，支持0-2
                // shade: false,
                shade: 0.3,
                shadeClose: false, //是否开启遮罩关闭
            });

            var url = "{{route('webSetting.webInfo.editPost')}}";
            var title = "修改成功";
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
                        swal.fire({
                            title: title,
                            text: "页面将会自动跳转，请等待",
                            icon : "success",
                            showConfirmButton: false,
                            showCancelButton: false,
                            timer: 3000
                        }).then(
                            setTimeout(function() {
                                window.location.reload();
                            },2000)
                        );
                    }else if(data.code == 10001){
                        layer.msg(data.msg);
                    }else{
                        swal.fire({
                            title: "操作失败，请刷新重试!",
                            text: data.msg,
                            icon: "error",
                            timer: 3000
                        });
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