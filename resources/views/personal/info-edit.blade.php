<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <title>个人信息修改</title>
    <link rel="stylesheet" href="{{asset('/css/frozen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/MultiPicker.css')}}">
    <link rel="stylesheet" href="{{asset('/css/DateSelector.css')}}">
</head>
<body>
    <header class="head-bar">
        <div class="bar-left">
            <a href="javascript:history.back()" class="goback"></a>
        </div>
        <div class="head-title">个人中心修改</div>
    </header>
    <div class="home_card ui-form-item-link">
        <a href="" class="">
            <div class="user_info_main">
                <p class="user_info_name">头像</p>
            </div>
            <img  src="https://gss0.bdstatic.com/6LZ1dD3d1sgCo2Kml5_Y_D3/sys/portrait/item/86cdc0fbb4a8c9f1bbb0633a?t=1473298580"  class="home_card_head_img">
        </a>
    </div>
    <div class="m-top">
        <div class="ui-list ui-list-text ui-border-b m-top">
            <li class="ui-border-t">
                <div class="ui-list-info">
                    <h4>昵称</h4>
                </div>
                <div class="ui-list-action" id="name">I'm here.</div>
            </li>
        </div>
        <div class="ui-list ui-list-text ui-border-b">
            <li class="ui-border-t">
                <div class="ui-list-info">
                    <h4>手机号</h4>
                </div>
                <div class="ui-list-action" id="phone">13387525826</div>
            </li>
        </div>
        <div class="ui-list ui-list-text ui-border-b ui-list-link">
            <li class="ui-border-t" onclick="infoEdit(name_html,this,'name')">
                <h4 class="ui-nowrap">真实姓名</h4>
                <div class="ui-txt-info">李四</div>
            </li>
        </div>
        <div class="ui-list ui-list-text ui-border-b ui-list-link" onclick="infoEdit(sex_html,this,'sex')">
            <li class="ui-border-t">
                <h4 class="ui-nowrap">性别</h4>
                <div class="ui-txt-info">男</div>
            </li>
        </div>
        <div class="ui-list ui-list-text ui-border-b ui-list-link">
            <li class="ui-border-t">
                <h4 class="ui-nowrap">出生日期</h4>
                <div class="ui-txt-info">1995-3-10</div>
                <span id="multiPickerInput"></span>
            </li>
        </div>
        <div class="ui-list ui-list-text ui-border-b ui-list-link" onclick="infoEdit(email_html,this,'email')">
            <li class="ui-border-t">
                <h4 class="ui-nowrap">电子邮箱</h4>
                <div class="ui-txt-info">85642319@qq.com</div>
            </li>
        </div>
        <div class="ui-list ui-list-text ui-border-b ui-list-link">
            <li class="ui-border-t">
                <h4 class="ui-nowrap">工作地址</h4>
                <div class="ui-txt-info">湖北省-武汉市-江夏区</div>
                <span id="addrInput"></span>
            </li>
        </div>
    </div>
    <script src="{{asset('/js/zepto.min.js')}}"></script>
    <script src="{{asset('/js/layer.js')}}"></script>
    <script src="{{asset('/js/city.js')}}"></script>
    <script src="{{asset('/js/DateSelector.js')}}"></script>
    <script src="{{asset('/js/MultiPicker.js')}}"></script>
    <script>
        function postForm(url,data,myFuc) {
            $.ajax({
                type: "post",
                data: data,
                url: url,
                dataType: "json",
                success: function(res){
                    if(res.code == 200) {
                        layer.open({
                            content: res.message
                            ,skin: 'msg'
                            ,time: 2
                        });
                        myFuc();
                    } else {
                        layer.open({
                            content: res.message
                            ,skin: 'msg'
                            ,time: 2
                        });
                    }
                }
            });
        }
        var name = document.getElementById('name').innerText;
        var phone = document.getElementById('phone').innerText;
        var data = {
            name:name,
            phone:phone,
        };
        var name_html = '<div class="ui-form">'+
                            '<div class="ui-form-item ui-form-item-pure ui-border-radius ui-form">'+
                                '<input type="text" placeholder="请输入姓名" name="name" id="real_name" value="吴越">'+
                            '</div>'+
                        '</div>'
        var sex_html = '<div class="ui-form">'+
                            '<ul class="ui-list ui-list-text" id="sex">'+
                                '<div class="text-left m-top">'+
                                    '<label class="ui-radio">'+
                                        '<input type="radio" checked name="sex" value="男">'+
                                    '</label>'+
                                    '<span>男</span>'+
                                '</div>'+
                                '<div class="text-left m-top">'+
                                    '<label class="ui-radio">'+
                                        '<input type="radio" name="sex" value="女">'+
                                    '</label>'+
                                    '<span>女</span>'+
                                '</div>'+
                            '</ul>'+
                        '</div>'
        var email_html = '<div class="ui-form">'+
                             '<div class="ui-form-item ui-form-item-pure ui-border-radius ui-form">'+
                                 '<input type="text" placeholder="请输入邮箱" name="name" id="email" value="85642319@qq.com">'+
                             '</div>'+
                         '</div>'
        function infoEdit(html,el,type) {
            layer.open({
                content: html
                ,className:'apply'
                ,btn: ['保存', '取消']
                ,yes: function(index){
                    switch (type){
                        case 'name':
                            var real_name = document.getElementById('real_name').value;
                            data.read_name = real_name;
                            console.log(data)
                            if (real_name.length == 0) {
                                layer.open({
                                    content: "姓名不能为空！"
                                    ,skin: 'msg'
                                    ,time: 2
                                });
                            }else {
                                postForm('/personal/info-edit',data,function () {
                                    $(el).find('.ui-txt-info').html(real_name);
                                })
                            }
                            break;
                        case 'sex':
                            var sex = $('#sex').find("input[name='sex']:checked").val();
                            data.sex = sex;
                            console.log(data)
                            postForm('/personal/info-edit',data,function () {
                                $(el).find('.ui-txt-info').html(sex);
                            })
                            break;
                        case 'email':
                            var email = document.getElementById('email').value;
                            data.email = email;
                            console.log(data)
                            if (email.length == 0) {
                                layer.open({
                                    content: "邮箱不能为空！"
                                    ,skin: 'msg'
                                    ,time: 2
                                });
                            }else {
                                postForm('/personal/info-edit',data,function () {
                                    $(el).find('.ui-txt-info').html(email);
                                })
                            }
                            break;
                    }
                }
            });
        }
        //地址选择器
        new MultiPicker({
            input: 'addrInput',//点击触发插件的input框的id
            container: 'AddrContainer',//插件插入的容器id
            jsonData: $city,
            success: function (arr) {
                console.log(arr.length)
                if(arr.length == 1){
                    data.province = arr[0].value;
                    var addr = arr[0].value;
                }else if(arr.length ==2){
                    data.province = arr[0].value;
                    data.city = arr[1].value;
                    var addr = arr[0].value+'-'+arr[1].value;
                }else{
                    data.province = arr[0].value;
                    data.city = arr[1].value;
                    data.area = arr[2].value;
                    var addr = arr[0].value+'-'+arr[1].value+'-'+arr[2].value;
                }
                console.log(data)
                postForm('/personal/info-edit',data,function () {
                    $("#addrInput").siblings(".ui-txt-info").html(addr)
                })
            }//回调
        });
        //时间选择器
        new DateSelector({
            input: 'multiPickerInput',//点击触发插件的input框的id
            container: 'DateContainer',//插件插入的容器id
            type: 0,
            param: [1, 1, 1, 0, 0],
            beginTime: [],
            endTime: [],
            recentTime: [],
            success: function (arr) {
                var birthday = arr[0]+'-'+arr[1]+'-'+arr[2];
                data.birthday = birthday;
                console.log(data)
                postForm('/personal/info-edit',data,function () {
                    $("#multiPickerInput").siblings(".ui-txt-info").html(birthday)
                })
            }//回调
        });
    </script>
</body>
</html>