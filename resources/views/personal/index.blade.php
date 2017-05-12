<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>个人信息</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
<div class="ui-container">
    <ul class="ui-list ui-list-text ui-border-tb ui-top">
        <li class="ui-border-t">
            <h4 class="ui-nowrap">用户名</h4>
            <div class="ui-txt-info">{{$customer->nickname}}</div>
        </li>
        <li class="ui-border-t">
            <h4 class="ui-nowrap">手机号</h4>

            <div class="ui-txt-info">{{$customer->phone}}</div>
        </li>

    </ul>

    {{--<a href="/personal/order-list">--}}
        {{--<ul class="ui-list ui-list-text ui-list-link ui-border-tb ui-top">--}}
            {{--<li class="ui-border-t">--}}
                {{--<h4>我的订单</h4>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</a>--}}

    {{--<a href="/personal/collection-list">--}}
        {{--<ul class="ui-list ui-list-text ui-list-link ui-border-tb ui-top">--}}
            {{--<li class="ui-border-t">--}}
                {{--<h4>收藏商品</h4>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</a>--}}

    {{--<a href="/personal/attention-list">--}}
        {{--<ul class="ui-list ui-list-text ui-list-link ui-border-tb ui-top">--}}
            {{--<li class="ui-border-t">--}}
                {{--<h4>关注厂家</h4>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</a>--}}

    {{--<ul class="ui-list ui-list-text ui-list-link ui-border-tb ui-top">--}}
    {{--<li class="ui-border-t">--}}
    {{--<h4>联系客服</h4>--}}
    {{--</li>--}}
    {{--</ul>--}}
</div>

</body>
</html>