<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>电子登记</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<!--头部导航-->
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">电子登记</div>
</header>
<section>
    <div class="ui-form ui-border-t">
        <form action="#">
            <div class="ui-form-item ui-border-b">
                <label>
                    姓名
                </label>
                <input type="text" placeholder="输入姓名" />
            </div>
            <div class="ui-form-item ui-border-b">
                <label>性别</label>
                <div class="ui-select">
                    <select>
                        <option>男</option>
                        <option>女</option>
                    </select>
                </div>
            </div>
            <div class="ui-form-item ui-border-b">
                <label>
                    联系方式
                </label>
                <input type="text" placeholder="请输入联系方式" />
            </div>
            <div class="ui-form-item ui-border-b">
                <label>
                    工作单位
                </label>
                <input type="text" placeholder="请输入工作单位" />
            </div>
            <div class="ui-form-item ui-border-b">
                <label>
                    关注科室
                </label>
                <input type="text" placeholder="请输入关注科室" />
            </div>
            <div class="ui-form-item ui-form-item-textarea ui-border-b">
                <label>
                    主要意向
                </label>
                <textarea placeholder="请输入主要意向"></textarea>
            </div>
            <a href="" class="bottomBtn">提交</a>
        </form>
    </div>
</section>
</body>
</html>