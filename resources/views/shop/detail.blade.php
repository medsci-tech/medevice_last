<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>详情</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/swiper-3.4.2.min.css')}}">
</head>
<body>
<!--头部导航-->
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">产品详情</div>
</header>
<section class="product-details">
    <!-- 商品图片轮播 -->
    <div class="product-slide swiper-container">
        <div class="swiper-wrapper">
            @if($data->banners)
                @foreach($data->banners as $banner)
            <div class="swiper-slide">
                <img src="{{ $banner->image_url }}?imageView2/1/w/450/h/450/q/90">
            </div>
                @endforeach
            @endif
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <div class="product-info ui-border-b ui-border-t">
        <div class="product-title">{{$data->name}}</div>
        <div class="product-prices">零售价格：<em>{{$data->price}}</em></div>
    </div>
    <div class="product-cell">
        <a href="/shop/info?id={{$data->id}}">
            产品参数
        </a>
    </div>
    <div class="product-details-box ui-border-t">
        <ul class="details-nav">
            <li class="active" data-index="0">产品详情</li>
            <li data-index="1">招商信息</li>
            <li data-index="2">相关视频</li>
            <li data-index="3">相关产品</li>
        </ul>
        <div class="details-cont">
            <div class="details-list tab-content-active">
                <div class="product-imgs">
                    {!! $data->detail !!}
                </div>
            </div>
            <div class="details-list">
                <h5 class="explain">※ 请仔细阅读的作用说明，并在药师指导下购买和使用,这里是招商说明</h5>
                {!! $data->description !!}
            </div>
            <div class="details-list">
                <!-- 视频加载 -->
                @if($data->videos)
                    @foreach($data->videos as $key=>$video)
                        <div  class="video" id="id_video_container_{{ $key }}" style="width:100%;height:400px;"></div>
                    @endforeach
                @endif

            </div>
            <div class="details-list">
                <div class="product-list">
                    <ul>

                        @if($data_similar)
                            @foreach ($data_similar as $val)
                                <li>
                                    <a href="{{ url('product/detail/'.$val->id) }}" target="_blank"><img src="{{ $val->logo }}?imageView2/1/w/220/h/220/q/90" alt=""></a>
                                    <p class="price">零售价格：<em>{{ $val->price }}</em></p>
                                    <p class="title">{{ $val->name }}</p>
                                </li>
                            @endforeach
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="together-footer">
        <div class="together-box">
            <div class="together">我要合作</div>
            <div class="@if ($is_collect == 1) mark @endif">
                <i></i>
                收藏
            </div>
        </div>
    </div>
</section>
<script src="{{asset('/js/zepto.min.js')}}"></script>
<script src="{{asset('/js/swiper-3.4.2.jquery.min.js')}}"></script>
<script>
    var mySwiper = new Swiper ('.swiper-container', {
        pagination: '.swiper-pagination',
    })
    $(document).ready(function() {
        var widget = $('.product-details-box');
        var tabs = widget.find('ul li'),
                content = widget.find('.details-cont > .details-list');
        tabs.on('click', function (e) {
            e.preventDefault();
            var index = $(this).data('index');
            tabs.removeClass('active');
            content.removeClass('tab-content-active');
            $(this).addClass('active');
            content.eq(index).addClass('tab-content-active');
        });


        var navTop = $('.details-nav').offset().top;
        $(window).scroll(function(){
            var yheight=getScrollTop();
            if(yheight > navTop){
                $(".details-nav").addClass("fixed-details-nav")
            }else{
                $(".details-nav").removeClass("fixed-details-nav");
            }
        })
        function getScrollTop() {
            var scrollPos;
            if (window.pageYOffset) {
                scrollPos = window.pageYOffset; }
            else if (document.compatMode && document.compatMode != 'BackCompat')
            { scrollPos = document.documentElement.scrollTop; }
            else if (document.body) { scrollPos = document.body.scrollTop; }
            return scrollPos;
        }
    });
</script>

<script src="//qzonestyle.gtimg.cn/open/qcloud/video/h5/h5connect.js"></script>
<script>
    (function(){
                @if($data->videos)
                @foreach($data->videos as $key=> $video)
        var option_{{ $key }} ={"auto_play":"0","file_id":"{{ $video->qcloud_file_id }}","app_id":"{{ $video->qcloud_app_id }}","width":1024,"height":576,"https":1, "remember": 1};
        /*调用播放器进行播放*/
        new qcVideo.Player( "id_video_container_{{ $key }}", option_{{ $key }});
        @endforeach
        @endif
    })()
</script>

</body>
</html>