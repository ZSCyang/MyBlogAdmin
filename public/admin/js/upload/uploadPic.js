//图片上传预览    IE是用了滤镜。
function previewImage(file)
{
    var MAXWIDTH  = 538;
    var MAXHEIGHT = 358;
    var div = document.getElementById('preImg');

    if (file.files && file.files[0])
    {
        div.innerHTML ='<img id=imghead class="preview" onclick=$("#previewImg").click()>';
        var img = document.getElementById('imghead');
        img.onload = function(){
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            img.width  =  rect.width;
            img.height =  rect.height;
            //img.style.marginLeft = rect.left+'px';
            img.style.marginTop = rect.top+'px';
        }
        var input = document.getElementById('imgStatus');
        input.value = 2;
        var reader = new FileReader();
        reader.onload = function(evt){img.src = evt.target.result;}
        reader.readAsDataURL(file.files[0]);
    }
    else //兼容IE
    {
        var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=imghead class="preview">';
        var img = document.getElementById('imghead');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";
    }
}

function previewImage_multiple(file, preImg, previewImg, imghead,imgStatus)
{
    //var MAXWIDTH  = 538;
    //var MAXHEIGHT = 358;
    var div = document.getElementById(preImg);

    if (file.files && file.files[0])
    {
        div.innerHTML ='<img id='+imghead+' class="preview" onclick=$("#'+previewImg+'").click()>';
        var img = document.getElementById(imghead);
        /*img.onload = function(){
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            img.width  =  rect.width;
            img.height =  rect.height;
            //img.style.marginLeft = rect.left+'px';
            img.style.marginTop = rect.top+'px';
        }*/
        var input = document.getElementById(imgStatus);
        input.value = 2;
        var reader = new FileReader();
        reader.onload = function(evt){img.src = evt.target.result;}
        reader.readAsDataURL(file.files[0]);
    }
    else //兼容IE
    {
        var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id='+imghead+' class="preview">';
        var img = document.getElementById(imghead);
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        /*var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;"+sFilter+src+"\"'></div>";*/
        var input = document.getElementById(imgStatus);
        input.value = 2;
        div.innerHTML = "<div id="+imghead+" style='"+sFilter+src+"\"'></div>";
    }
}

function clacImgZoomParam( maxWidth, maxHeight, width, height ){
    var param = {top:0, left:0, width:width, height:height};
    if( width>maxWidth || height>maxHeight ){
        rateWidth = width / maxWidth;
        rateHeight = height / maxHeight;

        if( rateWidth > rateHeight ){
            param.width =  maxWidth;
            param.height = Math.round(height / rateWidth);
        }else{
            param.width = Math.round(width / rateHeight);
            param.height = maxHeight;
        }
    }
    param.left = Math.round((maxWidth - param.width) / 2);
    param.top = Math.round((maxHeight - param.height) / 2);
    return param;
}