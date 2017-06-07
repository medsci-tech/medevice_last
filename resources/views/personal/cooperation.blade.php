<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>我的合作</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">我的合作</div>
</header>
<section class="ui-panel ui-panel-pure ui-border-t cooperate">
    <ul class="ui-list ui-border-tb">
        @if($list)
            @foreach($list as $order)
                @foreach($order->products as $product)
        <li class="ui-border-t">
            <div class="ui-list-img">
                <span style="background-image:url({{ $product->logo }}?imageView2/1/w/200/h/200/q/90)"></span>
            </div>
            <div class="ui-list-info">
                <h5 class="ui-txt-sub ui-txt-default"><a href="/shop/detail?id={{$product->id}}" target="_blank">{{ $product->name }}</a></h5>
                <h6 class="ui-txt-tips">合作类型：
                    @if ($order->join_type)
                        @foreach (explode(',',$order->join_type) as $val)
                        {{ config('params')['join_type'][$val] }}
                        @endforeach</span>
                    @endif</h6>
                <h6 class="ui-txt-tips">合作时间：{{ str_limit($order->created_at, $limit = 10, $end = '') }}</h6>
                <h6 class="ui-txt-tips">联系人：{{ $order->real_name }}&nbsp;{{ $order->contact_phone }}</h6>
            </div>
        </li>
                @endforeach
            @endforeach
        @endif
    </ul>
</section>
</body>
</html>