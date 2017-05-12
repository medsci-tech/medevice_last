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
                        <div  class="video" id="id_video_container_{{ $key }}"></div>
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
            <div class="together" onclick="javascript:showOrderDia()">我要合作</div>
            <div class="mark @if ($is_collect == 1)active @endif"><!--active为已收藏状态，反之-->
                <i></i>
                收藏
            </div>
        </div>
    </div>

    <div class="ui-dialog" id="create">
        <div class="ui-dialog-cnt">
            <header class="ui-dialog-hd ui-border-b">
                <h3>完成申请</h3>
                <i class="ui-dialog-close" data-role="button" onclick="closeOrderDia()"></i>
            </header>
            <form action="#" style="padding: 5px">
                <div class="ui-form-item ui-form-item-pure ui-border-radius ui-form dialog-top">
                    <input type="text" placeholder="请输入姓名" name="name" id="name">
                </div>
                <div class="ui-form-item ui-form-item-pure ui-border-radius ui-form dialog-top">
                    <input type="text" placeholder="请输入联系电话" name="phone" id="phone">
                </div>

                    <input type="checkbox" name="join_type" value="1"><span>代理产品</span>
                    <input type="checkbox" name="join_type" value="2"><span>提供学术服务</span>
                    <input type="checkbox" name="join_type" value="3"><span>其他</span>


                <div class="ui-dialog-ft">
                    <button type="button" data-role="button" onclick="store({{$data->id}})">申请</button>
                    <button type="button" data-role="button" onclick="closeOrderDia()">取消</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="{{asset('/js/zepto.min.js')}}"></script>
<script src="{{asset('/js/layer.js')}}"></script>
<script src="{{asset('/js/swiper-3.4.2.jquery.min.js')}}"></script>

<script src="{{asset('/js/frozen.js')}}"></script>
<script>
    function showDia(success, title, content) {
        $("#dia_title").text(title);
        $("#dia_content").text(content);
        if(success) {
            $("#icon").removeClass().addClass("ui-icon-success success_dia");
        } else {
            $("#icon").removeClass().addClass("ui-icon-success ui-txt-warning");
        }
        document.getElementById("dialog").style.display = "-webkit-box";
    }
    function closeDia() {
        document.getElementById("dialog").style.display = "none";
    }

    function showOrderDia() {
        document.getElementById("create").style.display = "-webkit-box";
    }
    function closeOrderDia() {
        document.getElementById("create").style.display = "none";
    }
    function store(product_id) {
        real_name =  document.getElementById("name").value;
        contact_phone =  document.getElementById("phone").value;
        var obj=document.getElementsByName('join_type'); //选择所有name="'test'"的对象，返回数组
//取到对象数组后，我们来循环检测它是不是被选中
        var s='';
        for(var i=0; i<obj.length; i++){
            if(obj[i].checked) s+=obj[i].value+','; //如果选中，将value添加到变量s中
        }
        str=s.substring(0,s.length-1)

        $.ajax({
            url: '/shop/create-order',
            data: {
                product_id: product_id,
                real_name: real_name,
                contact_phone: contact_phone,
                join_type: str,
            },
            type: "get",
            dataType: "json",
            success: function (json) {
                if(json.success) {
                    closeOrderDia();
                    showDia(true, '申请成功', '合作申请提交成功,我们将会在两个工作日内与您联系！');
                } else {
                    showDia(true, '申请失败', '申请失败,请重试！');
                }
            },
            error: function (xhr, status, errorThrown) {
                showDia(true, '申请失败', '申请失败,请重试！');
                console.log("Sorry, there was a problem!");
            }
        });
    }
</script>
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
}
</script>

<script src="//qzonestyle.gtimg.cn/open/qcloud/video/h5/h5connect.js"></script>
<script>
    (function(){
                @if($data->videos)
                @foreach($data->videos as $key=> $video)
        var option_{{ $key }} ={"auto_play":"0","file_id":"{{ $video->qcloud_file_id }}","app_id":"{{ $video->qcloud_app_id }}","width":180,"https":1, "remember": 1};
        /*调用播放器进行播放*/
        new qcVideo.Player( "id_video_container_{{ $key }}", option_{{ $key }});
        @endforeach
        @endif
    })()
</script>

</body>
</html>