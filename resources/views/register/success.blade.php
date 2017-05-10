<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>注册成功</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
</head>
<body>
<div>
    <section class="ui-notice">
        <div class="ui-icon-success success_sign">
        </div>
        <p>注册成功</p>
        <div class="ui-notice-btn">
            <button class="ui-btn-primary ui-btn-lg" id="closeWindow">确定</button>
        </div>
    </section>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $js->config(array('checkJsApi','closeWindow'), false, false) ?>);

    wx.ready(function () {
        wx.checkJsApi({
            jsApiList: [
                'closeWindow'
            ],
            success: function (res) {
            }
        });

        document.querySelector('#closeWindow').onclick = function () {
            wx.closeWindow();
        };
    });

    wx.error(function (res) {
        alert("error:" + res.errMsg);
    });
</script>
</body>
</html>