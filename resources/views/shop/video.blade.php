<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>使用教程</title>
    <link rel="stylesheet" href="{{asset('/css/weui.css')}}">
</head>
<body>
    @foreach($videos as $video)
        <div style="padding: 5px;">
            <h3 style="width: 100%; text-align: center;">{{$video->video_name}}</h3>

            <div class="weui_cells weui_cells_access">
                <video controls="controls"
                       src="{{$video->video_url}}"
                       width="100%" height="100%"
                        >
                </video>
            </div>
        </div>
    @endforeach
</body>
</html>



