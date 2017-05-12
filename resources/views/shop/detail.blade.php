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
        <a href="">
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
            </div>
            <div class="details-list">
                <div class="video">
                    视频
                </div>
                <div class="video">
                    视频
                </div>
            </div>
            <div class="details-list">
                <div class="product-list">
                    <ul>
                        <li>
                            <img src="http://oocc7psxo.bkt.clouddn.com/62f0acd40d5f4c870fc67c1ac0fa6016.jpg?imageView2/1/w/220/h/220/q/90" alt="">
                            <p class="price">零售价格：<em>￥99.99</em></p>
                            <p class="title">诺和笔5® 胰岛素笔试数显注射器</p>
                        </li>
                        <li>
                            <img src="http://oocc7psxo.bkt.clouddn.com/62f0acd40d5f4c870fc67c1ac0fa6016.jpg?imageView2/1/w/220/h/220/q/90" alt="">
                            <p class="price">零售价格：<em>￥99.99</em></p>
                            <p class="title">诺和笔5® 胰岛素笔试数显注射器</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="together-footer">
        <div class="together-box">
            <div class="together">我要合作</div>
            <div class="mark">
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
</body>
</html>