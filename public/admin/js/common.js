<!--刷新当前页面-->
$(document).ready(function(){
    $("#loading-example-btn").click(function(){
        location.reload();
    });
});


/**
 * 操作前确认提醒
 * @param msg
 */
function confirm_remind() {
    layer.confirm("确定进行此操作", {
        btn: ['确定','取消'], //按钮
    }, function(){
        var index = layer.load(0, {//0代表加载的风格，支持0-2
            shade: false,
            shade: 0.3,
            shadeClose: false, //是否开启遮罩关闭
        });
    }, function () {
        layer.msg('取消', {});   // 点击取消按钮，弹出框消失，页面不跳转
        return false;
    });
}


function del_btn(url) {
    layer.confirm('确定删除？', {
        btn: ['删除', '取消'] //按钮
    }, function () {
        layer.msg('删除成功', {icon: 1});   //点击删除按钮，页面跳转
        //self.location.href =  url
    }, function () {
        layer.msg('取消', {});   // 点击取消按钮，弹出框消失，页面不跳转
    });
}

/**
 * 删除提示统一方法
 * @param routeUrl
 * @param title
 */
function delete_ajax(routeUrl, title = '您确定要删除这条信息吗') {
    swal.fire({
        title: title,
        text: "删除后将无法恢复，请谨慎操作！",
        icon: 'warning',
        showCancelButton: true,
        //confirmButtonColor: '#3085d6',
        //cancelButtonColor: '#d33',
        confirmButtonText: '删除',
        cancelButtonText: "取消",
        closeOnConfirm: false
    }).then((result) => {
        if (result.value) {
            var index = layer.load(0, {
                shade: 0.3
            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                dataType: "json",
                url: routeUrl,
                success : function(data) {
                    console.log(data);
                    layer.close(index);
                    if (data.code == 200) {
                        swal.fire({
                            title: "删除成功",
                            text: "页面将会自动跳转，请等待",
                            icon : "success",
                            showConfirmButton: false,
                            showCancelButton: false,
                            timer: 30000
                        }).then(
                            setTimeout(function() {
                                window.location.reload();
                            },2000)
                        );
                    } else {
                        swal.fire({
                            title: "操作失败，请刷新重试!",
                            text: data.msg,
                            icon: "error",
                            timer: 3000
                        });
                    }
                },
                error : function (msg) {
                    layer.close(index);
                    swal.fire({
                        title: "删除失败!",
                        text: "id不存在或已被删除",
                        icon: "error",
                        timer: 3000
                    });
                }
            });
        }
    })
}

