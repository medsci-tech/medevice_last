<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>完善密码</title>
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
</head>
<body>
<div class="ui-container signup-top signup-padding">
    <div class="ui-border-radius signup-padding signup-shadow">
        <form action="{{url('/register/set-pwd')}}" method="POST" id="signup-form" id="signup-form">
            <div class="ui-form-item ui-form-item-pure ui-border-radius ui-form">
                <input type="password" placeholder="请输入密码" id="password" name="password"
                       value="{{ isset($input) ? $input['password'] : '' }}">
                <a href="#" class="ui-icon-close" onclick="clean('password')"></a>
            </div>
            <h6 class="ui-txt-warning" id="label_password">{{ isset($errors) ?  $errors->first('password') : '' }}</h6>

            <div class="ui-btn-wrap">
                <button class="ui-btn-lg ui-btn-primary" type="submit">
                    完善密码
                </button>
            </div>
        </form>
    </div>
</div>
<script src="http://cdn.bootcss.com/bootswatch/2.0.2/js/jquery.js"></script>
<script src="http://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" language="javascript">
    function clean(id) {
        document.getElementById(id).value = "";
    }

    $().ready(function () {
        $("#signup-form").validate({
            rules: {
                phone: "required",
                code: {
                    required: true,
                    rangelength: [6, 6]
                }
            },
            messages: {
                phone: '手机号不能为空',
                code: {
                    required: "验证码不能为空",
                    rangelength: "验证码格式不正确"
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "phone") {
                    $("#label_phone").empty();
                    $("#label_phone").append(error.html())
                }

                if (element.attr("name") == "code") {
                    $("#label_code").empty();
                    $("#label_code").append(error.html());
                }
            }
        });
    });

    function validateMobile() {
        var mobile = document.getElementById('phone').value;
        if (mobile.length == 0) {
            document.getElementById('label_phone').innerText = '请输入手机号码！';
            document.getElementById('phone').focus();
        }
        if (mobile.length != 11) {
            document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
            document.getElementById('phone').focus();
            return false;
        }

        var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
        if (!myreg.test(mobile)) {
            document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
            document.getElementById('phone').focus();
            return false;
        }
        return true;
    }

    function sendMessage() {
        if (validateMobile()) {
            $('#code_bt').attr("disabled", "disabled");
            var mobile = document.getElementById('phone').value;
            $.get(
                    '/register/send-message?phone=' + mobile,
                    function (json) {
                        if (json.success) {
                            document.getElementById('label_phone').innerText = '';
                        } else {
                            $('#code_bt').removeAttr("disabled");
                        }
                    },
                    "json"
            );

            var i = 61;
            timer();
            function timer() {
                i--;
                $('#code_bt').text(i + '秒后重发');
                if (i == 0) {
                    clearTimeout(timer);
                    $('#code_bt').removeAttr("disabled");
                    $('#code_bt').text('重新发送');
                } else {
                    setTimeout(timer, 1000);
                }
            }
        }
    }
</script>
</body>
</html>
