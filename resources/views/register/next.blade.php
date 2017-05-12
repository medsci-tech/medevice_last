<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>完善密码</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>
<header class="head-bar">
    <div class="bar-left">
        <a href="javascript:history.back()" class="goback"></a>
    </div>
    <div class="head-title">设置密码</div>
</header>
<div class="ui-form ui-border-t">
    <form action="" method="post">
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input type="text" placeholder="设置用户名" name="name" id="name">
        </div>
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input type="password" placeholder="设置密码" name="password" id="password">
        </div>
        <div class="ui-form-item ui-form-item-pure ui-border-b">
            <input type="password" placeholder="再次输入密码" name="password_confirmation" id="password_confirmation">
        </div>
        <input type="hidden" name="phone" value="{{ $phone }}" />
        <input type="hidden" name="openid" value="{{ $openid }}" />
        <button class="bottomBtn" type="button" name="submit">完成</button>
    </form>
</div>
<script src="{{asset('/js/zepto.min.js')}}"></script>
<script src="{{asset('/js/layer.js')}}"></script>
<script src="/js/zepto.min.js"></script>
<script src="/js/layer.js"></script>
<script>
    var phone='{{ $phone }}';
    var openid='{{ $openid }}';
    if(!phone || !openid)
    {
       window.location.href='/register/create';
    }
    $('button[name="submit"]').on('click', function(e){
        var name =$('#name').val();
        var password =$('#password').val();
        var password_confirmation =$('#password_confirmation').val();
        if (name == '') {
            layer.open({
                content: '用户名不能为空'
                ,skin: 'msg'
                ,time: 3
            });
            return false;
        }
        if (password=='') {
            layer.open({
                content: '密码不能为空'
                ,skin: 'msg'
                ,time: 3
            });
            return false;
        }
        if (password.length<6 || password.length>12) {
            layer.open({
                content: '密码介于6-12位'
                ,skin: 'msg'
                ,time: 3
            });
            return false;
        }
        if (password!=password_confirmation) {
            layer.open({
                content: '两次输入的密码不一致'
                ,skin: 'msg'
                ,time: 3
            });
            return false;
        }
        var form = $("form");
        $.ajax({
            type: 'POST',
            url: '/register/next',
            data: form.serialize(),
            success: function(json){
                if(json.status == "0") {
                    layer.open({
                        content: json.message
                        ,skin: 'msg'
                        ,time: 3
                    });

                }else{
                    layer.open({
                        content: json.message
                        ,skin: 'msg'
                        ,time: 3
                    });
                    window.location.href='/shop';
                   //window.location.href=document.referrer;
                    //$('#addForm')[0].reset()
                }
            },
        });

    })

</script>


</body>
</html>
