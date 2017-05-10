<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>视频讲堂</title>
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
<div>
@foreach($videos as $video)
        <div class="panel panel-default">
            <div class="panel-header"><b>产品名称</b>：<br><span>{{$video->product->name}}</span></div>
            <div class="panel-header"><a href="/shop/detail?id={{$video->product_id}}">查看该产品详情</a></div>
            <div class="panel-body">
            <video controls="controls"
                   src="{{$video->video_url}}"
                   width="100%" height="100%"
                    >
            </video>
        </div>
    </div>
@endforeach
</div>
</body>
</html>