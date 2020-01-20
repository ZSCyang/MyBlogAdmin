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
    <form class="form-horizontal m-t-md" action="{{ route('admins.post_changeAvatr') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox-title">
                    <h5>用户管理</h5><h5>&nbsp;>&nbsp;</h5><h5>修改头像</h5>
                    <div class="ibox-tools" style="margin-top:-5px;">
                        <a class="menuid btn btn-primary btn-sm" href="javascript:void(0);" onclick="parent.location.reload();">返回</a>
                        <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>我的头像</h5>
                        </div>
                        <div class="ibox-content" style="text-align:center;">
                            <button id="replaceImg" class="l-btn" type="button">更换图片</button>
                            <div style="width: 220px;height: 220px;border: solid 1px #555;padding: 5px;margin:auto;margin-top:12px;" >
                                @if($avatr == null)
                                    <img id="finalImg" src="{{URL::asset('images/up_photo.png')}}" width="100%">
                                @else
                                    <img id="finalImg" src="{{$avatr}}" width="100%" class="new_photo">
                                @endif
                                <input type="text" value="1" style="display: none;" id="is_update" name="is_update"/>
                                <input type="text" value="" style="display: none;" id="avatr" name="avatr"/>
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
                        <button class="btn btn-primary " type="submit" id="submit_editPhone"><i class="fa fa-check"></i>&nbsp;提交</button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-default " type="button" onclick="parent.location.reload();"><i class="fa fa-times"></i>&nbsp;&nbsp;取消</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <!--图片裁剪框 start-->
    <div style="display: none" class="tailoring-container">
        <div class="black-cloth" onclick="closeTailor(this)"></div>
        <div class="tailoring-content">
            <div class="tailoring-content-one">
                <label title="上传图片" for="chooseImg" class="l-btn choose-btn">
                    <input type="file" accept="image/jpg,image/jpeg,image/png" id="chooseImg" class="hidden" onchange="selectImg(this)">
                    选择图片
                </label>
                <div class="close-tailoring"  onclick="closeTailor(this)">×</div>
            </div>
            <div class="tailoring-content-two">
                <div class="tailoring-box-parcel">
                    <img id="tailoringImg">
                </div>
                <div class="preview-box-parcel">
                    <p>图片预览：</p>
                    <div class="square previewImg"></div>
                    <div class="circular previewImg"></div>
                </div>
            </div>
            <div class="tailoring-content-three">
                <button class="l-btn cropper-reset-btn">复位</button>
                <button class="l-btn cropper-rotate-btn">旋转</button>
                <button class="l-btn cropper-scaleX-btn">换向</button>
                <button class="l-btn sureCut" id="sureCut">确定</button>
            </div>
        </div>
    </div>
    <!--图片裁剪框 end-->


@endsection

@section('js')


    <!--头像裁切上传-->
    <script src="{{URL::asset('js/imgCropping/cropper.min.js')}}"></script>
    <script src="{{URL::asset('js/imgCropping/cropping.upload.js')}}"></script>

    <script>
        //裁剪后的处理
        $("#sureCut").on("click",function () {
            if ($("#tailoringImg").attr("src") == null ){
                return false;
            }else{
                var cas = $('#tailoringImg').cropper('getCroppedCanvas');//获取被裁剪后的canvas
                var base64url = cas.toDataURL('image/png'); //转换为base64地址形式
                $("#finalImg").prop("src",base64url);//显示为图片的形式
                $("#avatr").val(base64url);//上传的值
                $("#finalImg").prop("class","new_photo");
                $("#is_update").val(2);
                //关闭裁剪框
                closeTailor();
            }
        });
    </script>

@endsection
