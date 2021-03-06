<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>我的消息</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
    <header class="head-bar">
        <div class="bar-left">
            <a href="javascript:history.back()" class="goback"></a>
        </div>
        <div class="head-title">我的消息</div>
    </header>
    <div>
        <ul class="ui-list ui-list-pure ui-border-tb">
            @if ($list)
                @foreach ($list as $val)
            <li class="ui-border-t">
                <p>{{ $val->created_at }}</p>
                <div class="ui-txt-default">{{ $val->content }}</div>
            </li>
                @endforeach
            @endif
        </ul>
    </div>
</body>
</html>