<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>我的预约</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
    <header class="head-bar">
        <div class="bar-left">
            <a href="javascript:history.back()" class="goback"></a>
        </div>
        <div class="head-title">我的预约</div>
    </header>
    <div class="nav-tab ui-border-b">
        <ul class="tab">
            <li class="tab-item @if ($status=='') tab-active @endif">
                <a href="{{ url('personal/appointment/') }}">全部{{ $count }}</a>
            </li>
            <li class="tab-item @if ($status==2) tab-active @endif">
                <a href="{{ url('personal/appointment/2') }}">已预约{{ isset($count_list[2]) ? $count_list[2] : 0 }}</a>
            </li>
            <li class="tab-item @if ($status==1) tab-active @endif">
                <a href="{{ url('personal/appointment/1') }}">已审核{{ isset($count_list[1]) ? $count_list[1] : 0 }}</a>
            </li>
            <li class="tab-item @if ($status==0) tab-active @endif">
                <a href="{{ url('personal/appointment/0') }}">进行中{{ isset($count_list[0]) ? $count_list[0] : 0 }}</a>
            </li>
            <li class="tab-item @if ($status==3) tab-active @endif">
                <a href="{{ url('personal/appointment/3') }}">已完成{{ isset($count_list[3]) ? $count_list[3] : 0 }}</a>
            </li>
        </ul>
    </div>
    <section class="ui-panel ui-panel-pure ui-border-t m-top">
        <ul class="ui-list ui-list-pure ui-border-tb ui-list-link ui-list-text">
            @if($list)
                @foreach($list as $order)
            <li class="ui-border-t">
                <h4 class="m-b5">{{ $order->product_name }}</h4>
                <p>{{ $order->province.$order->city.$order->area }}</p>
                <h5><span class="date"> {{ str_limit($order->appoint_at, $limit = 10, $end = '') }}</span></h5>
            </li>
                @endforeach
            @endif
        </ul>
    </section>
</body>
</html>