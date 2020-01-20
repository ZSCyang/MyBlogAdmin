@extends('admin.layouts.layout')
@section('css')
    <style>
        .lightBoxGallery img {
            margin: 5px;
            width: 160px;
        }
    </style>


    <!--头像上传样式-->
    <link rel="stylesheet" href="{{URL::asset('css/imgCropping/cropper.min.css')}}"/>
    <link rel="stylesheet" href="{{URL::asset('css/imgCropping/ImgCropping.css')}}"/>


@endsection
@section('content')
    <form class="form-horizontal m-t-md" action="{{ route('admins.post_changePsw') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-title">
                    <h5>用户管理</h5><h5>&nbsp;>&nbsp;</h5><h5>修改密码</h5>
                    <div class="ibox-tools" style="margin-top:-5px;">
                        <a class="menuid btn btn-primary btn-sm" href="javascript:void(0);" onclick="parent.location.reload();">返回</a>
                        <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="ibox float-e-margins" >
                        <div class="ibox-title">
                            <h5>基本信息</h5>
                        </div>
                        <div class="ibox-content form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">原始密码：</label>
                                <div class="col-sm-4">
                                    <input name="oldPwd" minlength="6" type="password" class="form-control" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">新密码：</label>
                                <div class="col-sm-4">
                                    <input  type="password" minlength="6" class="form-control" name="newPwd" required="" aria-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">确认密码：</label>
                                <div class="col-sm-4">
                                    <input type="password" minlength="6" class="form-control" name="rePwd" required="" aria-required="true">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-content" style="height: 80px;text-align: center;">
                    <div style="margin-top:9px;">
                        <button class="btn btn-primary " type="submit" id="submit_changePsw"><i class="fa fa-check"></i>&nbsp;提交</button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default " type="button" onclick="parent.location.reload();"><i class="fa fa-times"></i>&nbsp;&nbsp;取消</button>
                    </div>
                </div>
            </div>
        </div>

    </form>


@endsection


