<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>个人信息</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
    <header class="head-bar">
        <div class="bar-left">
            <a href="javascript:history.back()" class="goback"></a>
        </div>
        <div class="head-title">个人中心</div>
    </header>
    <div class="home_card ui-form-item-link">
        <a href="/personal/info-edit" class="">
            <img  src="{{ isset($customer->head_img) ? $customer->head_img.'?imageView2/1/w/75/h/75/q/90' : $customer->head_image_url }}"  class="home_card_head_img">
            <div class="user_info_main">
                <p class="user_info_name">利川神话</p>
                <p class="user_info_phone">1335435346</p>
            </div>
        </a>
    </div>
    <div class="ui-form ui-border-t m-top">
        {{--<div class="ui-form-item ui-form-item-link ui-border-b">--}}
            {{--<a href="/personal/expertise" class="ui-txt-default">--}}
                {{--<p>我的专长</p>--}}
            {{--</a>--}}
        {{--</div>--}}
        {{--<div class="ui-form-item ui-form-item-link ui-border-b">--}}
            {{--<a href="/personal/enterprise" class="ui-txt-default">--}}
                {{--<p>企业认证</p>--}}
            {{--</a>--}}
        {{--</div>--}}
        <div class="ui-form-item ui-form-item-link ui-list-text ui-border-b">
            <a href="/personal/message" class="ui-txt-default">
                <p>我的消息</p>
            </a>
        </div>
        <div class="ui-form-item ui-form-item-link ui-border-b">
            <a href="/personal/collection-list" class="ui-txt-default">
                <p>我的收藏</p>
            </a>
        </div>
        <div class="ui-form-item ui-form-item-link ui-border-b">
            <a href="/personal/cooperation" class="ui-txt-default">
                <p>我的合作</p>
            </a>
        </div>
        <div class="ui-form-item ui-form-item-link ui-border-b">
            <a href="/personal/appointment" class="ui-txt-default">
                <p>我的预约</p>
            </a>
        </div>
        <div class="ui-form-item ui-form-item-link ui-border-b">
            <a href="/personal/attention-list" class="ui-txt-default">
                <p>关注厂家</p>
            </a>
        </div>
    </div>
</body>
</html>