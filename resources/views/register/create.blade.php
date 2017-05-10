<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>登录</title>
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
</head>
<body>
<!--头部导航-->
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">绑定手机号</div>
</header>
<div class="demo-block">
    <div class="ui-form ui-border-t">
        <form action="#">
            <div class="ui-form-item ui-form-item-pure ui-border-b">
                <input type="number" id="mobile" placeholder="输入手机号">
            </div>
            <div class="ui-form-item ui-form-item-r ui-border-b">
                <input type="text" id="code" placeholder="请输入验证码">
                <a href="javascript:;" class="getMobileCode" id="code_phone" onclick="sendMessage()">获取验证码</a>
            </div>
            <a href="" class="bottomBtn" onclick="register()">绑定</a>
        </form>
    </div>
</div>
<script src="js/zepto.min.js"></script>
<script src="js/layer.js"></script>
<script>
    function validateMobile() {
        var mobile = document.getElementById('mobile').value;
        if (mobile.length == 0) {
            layer.open({
                content: '手机号不能为空'
                ,skin: 'msg'
                ,time: 2
            });
            document.getElementById('mobile').focus();
            return false;
        }
        var phoneReg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if (!phoneReg.test(mobile)) {
            layer.open({
                content: '请输入有效的手机号码'
                ,skin: 'msg'
                ,time: 2
            });
            document.getElementById('mobile').focus();
            return false;
        }
        if(mobile.length != 11){
            layer.open({
                content: '请输入有效的手机号码'
                ,skin: 'msg'
                ,time: 2
            });
            document.getElementById('mobile').focus();
            return false;
        }
        return true;
    }
    function sendMessage() {
        if (validateMobile()) {
            var form = $("form");
            $.ajax({
                type: 'POST',
                url: '',
                data: form.serialize(),
                success: function(json){
                    if(json.error == "0") {
                        layer.open({
                            content: json.message
                            ,skin: 'msg'
                            ,time: 2
                        });
                        var i = 61;
                        timer();
                        function timer() {
                            i--;
                            $('#code_phone').text(i + '秒后重发');
                            if (i == 0) {
                                clearTimeout(timer);
                                $('#code_phone').text('重新发送');
                            } else {
                                setTimeout(timer, 1000);
                            }
                        }

                    }else{
                        layer.open({
                            content: json.message
                            ,skin: 'msg'
                            ,time: 2
                        });
                    }
                },
            });
        }
    }

    function register()
    {
        if($('#mobile').val()==''){
            layer.open({
                content: '用户名不能为空'
                ,skin: 'msg'
                ,time: 2
            });
            return false;
        }

        if($('#code').val()==''){
            layer.open({
                content: '验证码不能为空'
                ,skin: 'msg'
                ,time: 2
            });
            return false;
        }
        var form = $("form");
        $.ajax({
            type: 'POST',
            url: '',
            data: form.serialize(),
            success: function(json){
                if(json.error == "0") {
                    location.href = '';
                }else{
                    layer.open({
                        content: json.message
                        ,skin: 'msg'
                        ,time: 2
                    });
                }
            },
        });
    };
</script>
</body>
</html>