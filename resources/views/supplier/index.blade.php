<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>入驻厂家</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
{{--<div class="ui-slider">--}}
{{--<ul class="ui-slider-content" style="width: 300%">--}}
{{--<li><span style="background-image:url(http://placeholder.qiniudn.com/640x200)"></span></li>--}}
{{--<li><span style="background-image:url(http://placeholder.qiniudn.com/640x200)"></span></li>--}}
{{--<li><span style="background-image:url(http://placeholder.qiniudn.com/640x200)"></span></li>--}}
{{--</ul>--}}
{{--</div>--}}

<div>
    <section class="ui-panel">
        <h2>厂家列表</h2>
        @foreach($suppliers as $supplier)
            <div class="list_img">
                <div class="ui-border-radius">
                    <a href="/supplier/detail?id={{$supplier->id}}"><img src="{{$supplier->logo_image_url}}"/></a>
                    <h5 class="ui-nowrap">{{$supplier->supplier_name}}</h5>
                    <span class="ui-badge">{{$supplier->fans}}人关注</span>
                </div>
            </div>
        @endforeach
    </section>
</div>




<script src="{{asset('/js/zepto.min.js')}}"></script>
<script src="{{asset('/js/frozen.js')}}"></script>
<script>
    //    (function(){
    //        var slider = new fz.Scroll('.ui-slider', {
    //            role: 'slider',
    //            indicator: true,
    //            autoplay: true,
    //            interval: 3000
    //        });
    //
    //        slider.on('beforeScrollStart', function(from, to) {
    //            console.log(from, to);
    //        });
    //
    //        slider.on('scrollEnd', function(cruPage) {
    //            console.log(curPage);
    //        });
    //
    //    })();
</script>
</body>
</html>