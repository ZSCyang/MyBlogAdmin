@extends('admin.layouts.layout')
@section('css')
    <link href="{{loadEdition('/admin/css/upload/uploadPic.css')}}" rel="stylesheet">
    <link href="{{loadEdition('/admin/css/zoom/zoom.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox-title">
                <h5>杂文管理 > <span class="current_nav">智慧语录列表</span></h5>
                <div class="ibox-tools" style="margin-top:-5px;">
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                </div>
            </div>
            <div class="ibox-content">

                <div class="row m-b-sm m-t-sm">
                    <div class="col-md-11"></div>
                    <div class="col-md-1">
                        <a href="#" link-url="javascript:void(0)">
                            <button class="btn btn-primary btn-sm" type="button" onclick="addWisdom();"><i class="fa fa-plus-circle"></i> 新增智慧语录</button>
                        </a>
                    </div>

                </div>
                <form method="post" action="" name="form">
                    {{csrf_field()}}
                    <table class="table table-striped table-bordered table-hover m-t-md">
                        <thead>
                        <tr>
                            <th class="text-center" width="120">主语录</th>
                            <th class="text-center" width="120">副语录</th>
                            <th class="text-center" width="120">备注</th>
                            <th class="text-center" width="100">状态</th>
                            <th class="text-center" width="100">有效时间</th>
                            <th class="text-center" width="120">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($wisdomsList) > 0)
                            @foreach($wisdomsList as $wisdom)
                                <tr id="data_{{$wisdom->id}}">
                                    <td class="text-center">{{$wisdom->title}}</td>
                                    <td class="text-center">{{$wisdom->subtitle}}</td>
                                    <td class="text-center">{{$wisdom->remark}}</td>
                                    <td class="text-center">{{$wisdom->status}}</td>
                                    <td class="text-center">
                                        <span>{{$wisdom->start_time}}</span>
                                        &nbsp;到&nbsp;
                                        <span>{{$wisdom->end_time}}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="javascript:void(0);" onclick="editWisdom({{ $wisdom->id }});"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-paste"></i>&nbsp;编辑</button></a>

                                            <a href="javascript:"><button class="btn btn-danger btn-xs btn-delete"  onclick="javascript:return delete_ajax('{{route('travels.wisdoms.deletePost',['wisdom_id'=>$wisdom->id])}}','您确定删除该智慧语吗？');" type="button" data-id=""><i class="fa fa-trash-o"></i> 删除</button></a>
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
                {{ $wisdomsList->appends([])->links() }}
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
@endsection

@section('outTag')
    <div class="modal inmodal" id="toggleModal" tabindex="12" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <i class="fa fa-plus-square modal-icon" id="icon"></i>
                    <h4 class="modal-title" id="dialog-title">添加智慧语录</h4>
                </div>
                <form onsubmit="return false;" id="form_dictionarie">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">主语录:</span>
                            <input type="text" id="title" name="title" placeholder="请输入主语录"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">副语录:</span>
                            <input type="text" id="subtitle" name="subtitle" placeholder="请输入副语录"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">备注:</span>
                            <input type="text" id="remark" name="remark" placeholder="请输入备注"  class="form-control" required>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">状态:</span>
                            <select class="form-control m-b" id="status" name="status" style="height: 32px;">
                                <option value="1">立即生效</option>
                                <option value="2" selected>放入仓库</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <span style="padding:0 15px 0 15px;">生效时间:</span>
                            <div class="input-daterange input-group" id="datepicker">
                                <input class="laydate-icon form-control layer-date" style="background: #fff;"  name="start_time" id="start_time" readonly="readonly" placeholder="YYYY-MM-DD" value="" required>
                                <span class="input-group-addon">到</span>
                                <input class="laydate-icon form-control layer-date" style="background: #fff;"  name="end_time" id="end_time" readonly="readonly" placeholder="YYYY-MM-DD" value="" required>
                            </div>
                        </div>
                        <input type="hidden" name="wisdom_id" id="wisdom_id" >
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
    {{--时间插件--}}
    <script src="{{URL::asset('js/plugins/layer/laydate/laydate.js')}}"></script>
    <script>
        var start={
            elem:"#start_time",
            format:"YYYY-MM-DD",
            min:laydate.now(),
            istime:false,
            // istoday:false,
            choose:function(datas){
                end.min=datas;
                end.start=datas
            }
        };
        var end={
            elem:"#end_time",
            format:"YYYY-MM-DD",
            istime:false,
            // istoday:false,
            choose:function(datas){
                start.max=datas;
            }
        };
        laydate(start);
        laydate(end);

        //添加导航栏页面
        function addWisdom() {
            $("#toggleModal").modal("toggle");
            $('#dialog-title').text('添加智慧语录');
            //修改图标
            $('#icon').removeClass("fa-edit");
            $('#icon').addClass("fa-plus-square");

            //初始化值
            $('#wisdom_id').val('');
            $('#title').val('');
            $('#subtitle').val('');
            $('#remark').val('');
            $('#start_time').val('');
            $('#end_time').val('');

            //操作标识
            $('#btn-submit').val('add');
        }


        //编辑页面
        function editWisdom(id) {

            $("#toggleModal").modal("toggle");
            $('#dialog-title').text('编辑智慧语录');
            $('#wisdom_id').val(id);
            $('#title').val($('#data_'+id).find('td').eq(0).text());
            $('#subtitle').val($('#data_'+id).find('td').eq(1).text());
            $('#remark').val($('#data_'+id).find('td').eq(2).text());
            $('#status').val($('#data_'+id).find('td').eq(3).text());
            $('#start_time').val($('#data_'+id).find('td').eq(4).children('span').eq(0).text());
            $('#end_time').val($('#data_'+id).find('td').eq(4).children('span').eq(1).text());

            //修改图标
            $('#icon').removeClass("fa-plus-square");
            $('#icon').addClass("fa-edit");

            $('#btn-create').hide();
            $('#btn-update').show();

            //操作标识
            $('#btn-submit').val('edit');
        };

        //添加封面图
        $('#form_dictionarie').submit(function () {
            $("#btn-submit").attr("disabled", "disabled");
            var index = layer.load(0, {//0代表加载的风格，支持0-2
                // shade: false,
                shade: 0.3,
                shadeClose: false, //是否开启遮罩关闭
            });

            var url = "{{route('travels.wisdoms.addPost')}}";
            var title = "添加成功";

            var submit_type = $('#btn-submit').val();
            if (submit_type=="edit") {
                var url = "{{route('travels.wisdoms.editPost')}}";
                var title = "修改成功";
            }

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
                            title: title,
                            text: "页面将会自动跳转，请等待",
                            showConfirmButton: false,
                            type: "success",
                            showCancelButton: false,
                            timer: 2000
                        }, function () {
                            window.location.reload()
                        })
                    }else if(data.code == 10001){
                        layer.msg(data.msg);
                    }else{
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
