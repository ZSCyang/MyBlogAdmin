@extends('admin.layouts.layout')
@section('css')
    <link href="{{loadEdition('/admin/css/upload/uploadPic.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row animated fadeInRight">
        <div class="col-sm-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>网站简介</h5>
                </div>
                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <div id="preImg" class="about_background_preImg">
                            <img id="imghead" class="preview" alt="image" class="img-responsive" src="{{URL::asset('/images/photo_icon.png')}}" onclick="$('#previewImg').click();">
                        </div>
                        <input type="file" name="imgfile" onchange="previewImage(this, 'preImg', 'previewImg', 'imghead','imgStatus')" style="display: none;" id="previewImg">
                        <input type="hidden" name="imgStatus" id="imgStatus" value="1">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong>简介标题</strong></h4>
                        <input type="text" class="form-control" name="bottom" value="" required data-msg-required="请输入中文名">

                        <h4><strong>关于我</strong></h4>
                        <div>
                            <textarea  style="width: 100%;" rows="8">好网</textarea>
                        </div>

                        <h4><strong>座右铭</strong></h4>
                        <div>
                            <textarea  style="width: 100%;" rows="2">我的座右铭</textarea>
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
                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i>编辑</button>
                        <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i>刷新</button>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list">
                        <div class="feed-element">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">中文名：</label>
                                <div class="input-group col-sm-10">
                                    <input type="text" class="form-control" name="bottom" value="" required data-msg-required="请输入中文名">
                                </div>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">英文名：</label>
                                <div class="input-group col-sm-10">
                                    <input type="text" class="form-control" name="bottom" value="" required data-msg-required="请输入英文名">
                                </div>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">生日：</label>
                                <div class="input-group col-sm-10">
                                    <input type="text" class="form-control" name="bottom" value="" required data-msg-required="请输入英文名">
                                </div>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">头像：</label>
                                <div class="input-group col-sm-10 photos">
                                    <div id="preImg1" class="about_preImg">
                                        <img id="imghead1" class="preview" alt="image" class="img-responsive" src="{{URL::asset('/images/photo_icon.png')}}" onclick="$('#previewImg1').click();">
                                    </div>
                                    <input type="file" name="imgfile" onchange="previewImage(this, 'preImg1', 'previewImg1', 'imghead1','imgStatus1')" style="display: none;" id="previewImg1">
                                    <input type="hidden" name="imgStatus" id="imgStatus1" value="1">
                                </div>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">标签：</label>
                                <div class="input-group col-sm-10">
                                    <input type="text" class="form-control" name="bottom" value="" required data-msg-required="请输入人物标签">
                                </div>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">微信：</label>
                                <div class="input-group col-sm-10">
                                    <div class="input-group col-sm-10 photos">
                                        <div id="preImg2" class="about_preImg">
                                            <img id="imghead2" class="preview" alt="image" class="img-responsive" src="{{URL::asset('/images/photo_icon.png')}}" onclick="$('#previewImg2').click();">
                                        </div>
                                        <input type="file" name="imgfile" onchange="previewImage(this, 'preImg2', 'previewImg2', 'imghead2','imgStatus2')" style="display: none;" id="previewImg2">
                                        <input type="hidden" name="imgStatus" id="imgStatus2" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('/admin/js/upload/uploadPic.js')}}"></script>
@endsection