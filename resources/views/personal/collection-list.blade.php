<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>我的收藏</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">我的收藏</div>
</header>
<section class="ui-panel ui-panel-pure ui-border-t cooperate mark-box">
    <ul class="ui-list ui-border-tb">

        @foreach($collections as $collection)
        <li class="ui-border-t">
            <div class="mark-info">
                <div class="ui-list-img">
                    <span style="background-image:url({{$collection->product->logo}}?imageView2/1/w/65/h/65/q/90)"></span>
                </div>
                <div class="ui-list-info">
                    <h5 class="ui-txt-sub ui-txt-default">{{$collection->product->name}}</h5>
                </div>
            </div>
            <div class="del ui-border-l" onclick="cancelCollect({{$collection->product->id}},this)">取消收藏</div>
        </li>
        @endforeach
    </ul>
</section>

<script src="{{asset('/js/zepto.min.js')}}"></script>
<script src="{{asset('/js/layer.js')}}"></script>
<script>
    function cancelCollect(product_id,el) {
        $.ajax({
            url: '/shop/cancel-collect',
            data: {
                product_id: product_id,
                action:0
            },
            type: "POST",
            dataType: "json",
            success: function (json) {
                if (json.code == 200) {
                    layer.open({
                        content: json.message
                        , skin: 'msg'
                        , time: 2
                    });
                    $(el).parent().remove();
                }
            },
            error: function (xhr, status, errorThrown) {
                console.log("Sorry, there was a problem!");
                layer.open({
                    content: "取消收藏失败！"
                    , skin: 'msg'
                    , time: 2
                });
            }
        });
    }
</script>
</body>
</html>