<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>我的收藏</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
<div>
    @foreach($collections as $collection)
        <ul class="ui-list  ui-border-tb" style="margin-top: 10px">
            <li class="ui-border-t">
                <div class="ui-list-info">
                    <h5>{{$collection->product->name}}</h5>
                </div>
            </li>
            <li class="ui-border-t">
                <div class="ui-list-thumb">
                    <span style="background-image:url({{$collection->product->logo}}?imageView2/1/w/65/h/65/q/90)"></span>
                </div>
                <div class="ui-list-info">
                    <a href="/shop/detail?id={{$collection->product->id}}">
                        <h5 class="ui-nowrap">{{$collection->product->name}}</h5>

                        <p class="ui-nowrap ui-txt-info">时间：{{$collection->created_at}}</p>
                    </a>
                </div>
            </li>
            <li class="ui-border-t">
                <div class="ui-list-info">
                    <h5>价格：<span class="ui-txt-warning">{{$collection->product->price}}</span></h5>
                    {{--<h5>价格：<span class="ui-txt-warning">￥{{$collection->product->price}}</span></h5>--}}
                </div>
                <div class="order_pay"><h6 class="ui-list-action ui-btn ui-btn-danger"
                                           onclick="cancelCollect({{$collection->product->id}})">取消收藏</h6></div>
            </li>
        </ul>
    @endforeach
</div>
<div class="ui-txt-tips ui-txt-info ui-flex ui-flex-pack-center ui-top">已经没有更多收藏了！</div>
<div class="ui-dialog" id="dialog">
    <div class="ui-dialog-cnt">
        <header class="ui-dialog-hd ui-border-b">
            <h3 id="dia_title"></h3>
            <i class="ui-dialog-close" data-role="button" onclick="closeDia()"></i>
        </header>
        <div class="ui-dialog-bd">
            <i class="ui-icon-success success_dia" id="icon"></i><h4 id="dia_content"></h4>
        </div>
        <div class="ui-dialog-ft">
            <button type="button" data-role="button" onclick="closeDia()">确定</button>
        </div>
    </div>
</div>

<script src="http://cdn.bootcss.com/bootswatch/2.0.2/js/jquery.js"></script>
<script>
    function showDia(success, title, content) {
        $("#dia_title").text(title);
        $("#dia_content").text(content);
        if (success) {
            $("#icon").removeClass().addClass("ui-icon-success success_dia");
        } else {
            $("#icon").removeClass().addClass("ui-icon-success ui-txt-warning");
        }
        document.getElementById("dialog").style.display = "-webkit-box";
    }
    function closeDia() {
        window.location.reload();
        document.getElementById("dialog").style.display = "none";
    }

    function cancelCollect(product_id) {
        $.ajax({
            url: '/shop/cancel-collect',
            data: {
                product_id: product_id
            },
            type: "get",
            dataType: "json",
            success: function (json) {
                if (json.success) {
                    showDia(true, '取消成功', '已取消收藏！');
                } else {
                    showDia(true, '取消失败', '取消收藏失败,请重试！');
                }
            },
            error: function (xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
                showDia(true, '关注失败', '关注失败,请重试！');
            }
        });
    }
</script>
</body>
</html>