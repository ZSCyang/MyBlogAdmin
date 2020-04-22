@extends('admin.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>网站设置 > <span class="current_nav">导航栏管理</span></h5>
                <div class="ibox-tools" style="margin-top:-5px;">
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                </div>
            </div>
            <div class="ibox-content">

                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-11"></div>
                    <div class="col-md-1">
                        <a href="#" link-url="javascript:void(0)">
                            <button class="btn btn-primary btn-sm" type="button" onclick="addNavbar();"><i class="fa fa-plus-circle"></i> 新增导航栏</button>
                        </a>
                    </div>

                </div>
                <form method="post" action="" name="form">
                    <table class="table table-striped table-bordered table-hover m-t-md">
                        <thead>
                        <tr>
                            <th class="text-center" width="100">名称</th>
                            <th class="text-center" width="150">连接</th>
                            <th class="text-center" width="150">备注</th>
                            <th class="text-center" width="100">添加时间</th>
                            <th class="text-center" width="100">更新时间</th>
                            <th class="text-center" width="150">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($navbarsList) > 0)
                            @foreach($navbarsList as $navbar)
                                <tr>
                                    <td class="text-center">{{$navbar->name}}</td>
                                    <td class="text-center">{{$navbar->url}}</td>
                                    <td class="text-center">{{$navbar->remark}}</td>
                                    <td class="text-center">{{$navbar->created_at}}</td>
                                    <td class="text-center">{{$navbar->updated_at}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href=""><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i>&nbsp;编辑</button></a>

                                            <a href="javascript:"><button class="btn btn-danger btn-xs btn-delete" onclick='' type="button" data-id=""><i class="fa fa-trash-o"></i> 删除</button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" style="color: red;text-align: center">暂无数据</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </form>
                {{ $navbarsList->appends([])->links() }}
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection

@section('outTag')
    <div class="modal inmodal" id="navbarModal" tabindex="12" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <i class="fa fa-plus-square modal-icon"></i>
                    <h4 class="modal-title" id="dialog-title">添加导航栏</h4>
                </div>
                <form onsubmit="return false;" id="form_add_navbar" class="save-form">
                    <div class="modal-body">
                        <input type="hidden" name="edit-id" value="">
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">名称:</span>
                            <input type="text" name="save_equipment_imei" id="navbar_name" placeholder="请输入导航栏名称"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">url:</span>
                            <input type="text" name="save_equipment_phone" id="navbar_url"  placeholder="请输入导航栏连接"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">备注:</span>
                            <input type="text" name="save_equipment_phone" id="navbar_remark"  placeholder="请输入备注信息"  class="form-control">
                        </div>
                        <input type="hidden" name="equipment_id" id="equipment_id" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary" id="btn-create">添加</button>
                        <button type="submit" class="btn btn-primary" id="btn-update" style="display: none;">修改</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script>
        //添加导航栏页面
        function addNavbar() {
            $("#navbarModal").modal("toggle");
        }

        $('#form_add_navbar').submit(function () {
            var index = layer.load(0, {//0代表加载的风格，支持0-2
                // shade: false,
                shade: 0.3,
                shadeClose: false, //是否开启遮罩关闭
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data : {
                    name: $('#navbar_name').val(),
                    url: $('#navbar_url').val(),
                    remark: $('#navbar_remark').val()
                },
                url : "{{route('webSetting.navBars.add')}}",
                success : function(data) {
                    layer.close(index); // 关闭当前提示
                    if(data.code == 200){
                        swal({
                            title: "添加成功!",
                            text: "页面将会自动跳转，请等待",
                            showConfirmButton: false,
                            type: "success",
                            showCancelButton: false,
                            timer: 2000
                        }, function () {
                            window.location.reload()
                        })
                    }else{
                        swal({
                            title: "添加失败，请刷新重试!",
                            text: data.message,
                            showConfirmButton: false,
                            type: "error",
                            showCancelButton: false,
                            timer: 2000
                        })
                    }
                },
                error : function (msg) {
                    layer.close(index); // 关闭当前提示
                    if (msg.status == 422) {
                        var json=JSON.parse(msg.responseText);
                        json = json.errors;
                        for ( var item in json) {
                            for ( var i = 0; i < json[item].length; i++) {
                                layer.msg(json[item][i]);
                                layer.close(index); // 关闭当前提示
                                $("#submit_school").removeAttr("disabled");
                                return false; //遇到验证错误，就退出
                            }
                        }

                    } else {
                        layer.msg('服务器连接失败');
                        layer.close(index); // 关闭当前提示
                        $("#submit_school").removeAttr("disabled");
                        return false;
                    }
                }
            });

        });
    </script>

@endsection
