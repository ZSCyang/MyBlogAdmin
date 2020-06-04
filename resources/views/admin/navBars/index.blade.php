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
                    {{csrf_field()}}
                    <table class="table table-striped table-bordered table-hover m-t-md">
                        <thead>
                        <tr>
                            <th class="text-center" width="120">名称</th>
                            <th class="text-center" width="140">连接</th>
                            <th class="text-center" width="140">备注</th>
                            <th class="text-center" width="100">状态</th>
                            <th class="text-center" width="100">添加时间</th>
                            <th class="text-center" width="100">更新时间</th>
                            <th class="text-center" width="120">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($navbarsList) > 0)
                            @foreach($navbarsList as $navbar)
                                <tr id="data_{{$navbar->id}}">
                                    <td class="text-center">{{$navbar->name}}</td>
                                    <td class="text-center">{{$navbar->url}}</td>
                                    <td class="text-center">{{$navbar->remark}}</td>
                                    <td class="text-center">{{$navbar->status}}</td>
                                    <td class="text-center">{{$navbar->created_at}}</td>
                                    <td class="text-center">{{$navbar->updated_at}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="javascript:void(0);" onclick="editNavbar({{ $navbar->id }});"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i>&nbsp;编辑</button></a>

                                            <a href="javascript:"><button class="btn btn-danger btn-xs btn-delete"  onclick="javascript:return delete_ajax('{{route('webSetting.navBars.deletePost',['navbar_id'=>$navbar->id])}}','您确定删除该导航栏吗？');" type="button" data-id=""><i class="fa fa-trash-o"></i> 删除</button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" style="color: red;text-align: center">暂无数据</td>
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
                    <i class="fa fa-plus-square modal-icon" id="icon"></i>
                    <h4 class="modal-title" id="dialog-title">添加导航栏</h4>
                </div>
                <form onsubmit="return false;" id="form_navbar">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="edit-id" value="">
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">名称:</span>
                            <input type="text"  id="navbar_name" placeholder="请输入导航栏名称"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">url:</span>
                            <input type="text" id="navbar_url"  placeholder="请输入导航栏连接"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">备注:</span>
                            <input type="text" id="navbar_remark"  placeholder="请输入备注信息"  class="form-control">
                        </div>
                        <input type="hidden" name="navbar_id" id="navbar_id" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit" value="add">添加</button>
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
            $('#dialog-title').text('添加导航栏');
            //修改图标
            $('#icon').removeClass("fa-edit");
            $('#icon').addClass("fa-plus-square");

            //初始化值
            $('#navbar_id').val('');
            $('#navbar_name').val('');
            $('#navbar_url').val('');
            $('#navbar_remark').val('');

            //操作标识
            $('#btn-submit').val('add');
        }


        //编辑页面
        function editNavbar(id) {

            $("#navbarModal").modal("toggle");
            $('#dialog-title').text('编辑导航栏');
            $('#navbar_id').val(id);
            $('#navbar_name').val($('#data_'+id).find('td').eq(0).text());
            $('#navbar_url').val($('#data_'+id).find('td').eq(1).text());
            $('#navbar_remark').val($('#data_'+id).find('td').eq(2).text());

            //修改图标
            $('#icon').removeClass("fa-plus-square");
            $('#icon').addClass("fa-edit");

            $('#btn-create').hide();
            $('#btn-update').show();

            //操作标识
            $('#btn-submit').val('edit');
        };

        //添加导航栏
        $('#form_navbar').submit(function () {

            $("#btn-submit").attr("disabled", "disabled");
            var index = layer.load(0, {//0代表加载的风格，支持0-2
                // shade: false,
                shade: 0.3,
                shadeClose: false, //是否开启遮罩关闭
            });

            var url = "{{route('webSetting.navBars.addPost')}}";
            var title = "添加成功";
            var sub_type = 'post';

            var submit_type = $('#btn-submit').val();
            if(submit_type=="edit"){
                var url = "{{route('webSetting.navBars.editPost')}}";
                var title = "修改成功";
                var sub_type = 'put';
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                type: sub_type,
                data : {
                    navbar_id: $('#navbar_id').val(),
                    name: $('#navbar_name').val(),
                    url: $('#navbar_url').val(),
                    remark: $('#navbar_remark').val()
                },
                url : url,
                success : function(data) {
                    layer.close(index); // 关闭当前加载提示
                    $("#btn-submit").removeAttr("disabled");//释放按钮
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
