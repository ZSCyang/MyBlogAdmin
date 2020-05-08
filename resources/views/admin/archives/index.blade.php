@extends('admin.layouts.layout')
@section('content')
    <form onsubmit="return false;" id="form_archives">
        {!! csrf_field() !!}
        <div id="test-editormd">
            <textarea name="test-editormd" style="display:none;"></textarea>
        </div>
        <button class="btn btn-primary" type="submit" id="btn-submit"><i class="fa fa-check"></i>&nbsp;保 存</button>
    </form>

    @include('markdown::encode',['editors'=>['test-editormd']])
@endsection

@section('js')
    <script>
        //编辑网站基础信息
        $('#form_archives').submit(function () {

            var url = "{{route('archives.addPost')}}";
            var data = new FormData(this);//获取非文本类的数据
            console.log(data);
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

                    alert(data);
                    console.log(data);

                },
            });

        });

    </script>

@endsection