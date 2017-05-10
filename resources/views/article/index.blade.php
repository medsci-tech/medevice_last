<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>最新资讯</title>
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
</head>
<body>
<div class="ui-slider">
    <ul class="ui-slider-content" style="width: 300%">
        <li><span style="background-image:url(http://7xshr6.com1.z0.glb.clouddn.com/zxt_1.png)"></span></li>
        <li><span style="background-image:url(http://7xshr6.com1.z0.glb.clouddn.com/zxt_2.png)"></span></li>
        <li><span style="background-image:url(http://7xso2p.com1.z0.glb.clouddn.com/MDKJ.png)"></span></li>
    </ul>
</div>

<div class="ui-tab">
    <ul class="ui-tab-nav ui-border-b">
        <li class="current">推荐图文</li>
        <li>热门文章</li>
    </ul>
    <ul class="ui-tab-content" style="width:300%">
        <li class="current">
            <ul class="ui-list ui-border-tb">
                @foreach($recommends as $article)
                    <li class="ui-border-t">
                        <div class="ui-list-img">
                            <span style="background-image:url({{$article->thumbnail}})"></span>
                        </div>
                        <div class="ui-list-info">
                            <a href="{{$article->url}}">
                                <h4 class="ui-nowrap">{{$article->title}}</h4>

                                <p class="ui-nowrap-multi">{{$article->description}}</p>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
        <li>
            <ul class="ui-list ui-border-tb">
                @foreach($hots as $article)
                    <li class="ui-border-t">
                        <div class="ui-list-img">
                            <span style="background-image:url({{$article->thumbnail}})"></span>
                        </div>
                        <div class="ui-list-info">
                            <a href="{{$article->url}}">
                                <h4 class="ui-nowrap">{{$article->title}}</h4>

                                <p class="ui-nowrap-multi">{{$article->description}}</p>
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>

<script src="{{asset('/js/zepto.min.js')}}"></script>
<script src="{{asset('/js/frozen.js')}}"></script>
<script>
    (function(){

        var slider = new fz.Scroll('.ui-slider', {
            role: 'slider',
            indicator: true,
            autoplay: true,
            interval: 3000
        });
    })();
    (function() {

        var tab = new fz.Scroll('.ui-tab', {
            role: 'tab',
            autoplay: false,
        });
    })();
</script>
</body>
</html>